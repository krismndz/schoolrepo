import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.math.*;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.lang.*;
import java.io.BufferedReader;
public class CacheSim {
	
	public static int SZ =1024;
	public static int cacheSzK;
	public static int cacheSz;
	public static int blockSz;
	public boolean trace;
	public static int tagSz;
	public static int indexSz;
	public static int offsetSz;
	public int blockCount;
	public String tag;
	public String index;
	public String offset;
	public ArrayList<String> tagBinaryList;
	public ArrayList<String> indexBinaryList;
	public ArrayList<String> offsetBinaryList;
	public char [] str;
	public int accessCount;
	public int misses;
	public int hits;
	public double missratio;
	public String traceflag;
	public static String filePath;
	public static String[] data;
	public String binaryString;
	public String [][]cache;
	public String tagbinary;
	public String indexbinary;
	public String offsetbinary;
	public boolean hm;
	public boolean out;
	public int tagdec;
	public int currlast;
	public int newlast;
	public int indexdec;
	public int offsetdec;
	public String taghex ;
	public String indexhex ;
	public int last;
	public String offsethex ;
	public int chkFulAssoc;
	public int lruDigits;
	public static int setTotal;
	public static int assoc;
	public static String policy;
	public CacheSim(int log2CacheSize, int log2blockSize,int p,String pol, String tf, String fp){
		policy = pol;
		assoc=(int) Math.pow(2,p);
		tagBinaryList = new ArrayList();
		indexBinaryList = new ArrayList();
		offsetBinaryList = new ArrayList();
		misses = 0;
		hits = 0;
		filePath = fp;
		traceflag = tf;
		out = false;
		last = 0;
		currlast = 0;
		
	
		chkFulAssoc = log2CacheSize-log2blockSize;
		
	
		
		try{
			this.setTraceFlag();
			this.checkParams(log2CacheSize);
		}catch(Exception e){
			System.out.println(e.getMessage());
			return;
		}
		
		try {
			
			data = this.getReadLines();
		} catch (IOException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
			System.out.println(e1.getMessage());
			return;
		}
		//clean data and set access count
				this.cleanData();
				
		this.setCacheSizes(log2CacheSize);
		this.setBlockSize(log2blockSize);
		this.setBlockCount();
		//the same no matter what
		this.setOffsetSize(log2blockSize);
		
		if(policy.equals("lru")){
			this.setLruDigits(assoc);
		}
		else if(policy.equals("fifo")){
			
		}
		if(p==0){
			this.setIndexSize();
			//DMC dmc = new DMC(log2CacheSize,log2blockSize,tf,fp);
		}else {
			
			
			
			
			
			if((p<0) ||(p>chkFulAssoc) ){
				setTotal=blockCount;
				indexSz=0;
		
				///FAC fac = new FAC(log2CacheSize, log2blockSize,p,policy,  tf,  fp);
			}else{
				
				this.setSetCount();
				this.setIndexSize();
				
			
				//LRU LRU = new LRU(log2CacheSize, log2blockSize,p,policy,  tf,  fp);
			
			}
			//this.printTest();
		}
		this.setTagSize();
		
		if(p==0){
			DMC dmc = new DMC(log2CacheSize,log2blockSize,tf,fp);
		}else {

			
			if((p<0) ||(p>chkFulAssoc) ){
				FAC fac = new FAC(log2CacheSize, log2blockSize,p,policy,  tf,  fp);
			}else{
				if(policy.equals("lru")){

					LRU lru = new LRU(log2CacheSize, log2blockSize,p,policy,  tf,  fp);
				}
				else if(policy.equals("fifo")){
					FIFO fifo = new FIFO(log2CacheSize, log2blockSize,p,policy,  tf,  fp);
				}

			
			}
			
		}
		
		this.printTest();
		
	}
	
	public void printTest(){
		System.out.println("Associativity: "+Integer.toString(assoc));
		System.out.println("Cache Size: "+Integer.toString(cacheSzK)+"K");
		System.out.println("Block Size: "+Integer.toString(blockSz));
		System.out.println("Block count: "+Integer.toString(blockCount));
		System.out.println("Index Bits: "+ Integer.toString(indexSz));
		System.out.println("Offset Bits: "+ Integer.toString(offsetSz));
		System.out.println("Tag Bits: "+ Integer.toString(tagSz));
		System.out.println("Set Total: "+ Integer.toString(setTotal));
		if(policy.equals("lru")){
			System.out.println("LRU Digits: "+ Integer.toString(lruDigits));
			
		}

	}
	public void checkParams(int log2CacheSize) throws Exception{
		
		if(log2CacheSize <= 0){
			System.err.println("Error in DMC: cache size must be greater than 0 ");
			return;
		}
		if(blockSz> cacheSz){
			throw new Exception("Error in DMC: block size cannot be bigger than cache size");
			//return;
		}
		
	}
	public void setLruDigits(int p){
		int fact = 1; // this  will be the result
        for (int i = 1; i <= p; i++) {
            fact *= i;
        }
        if(fact==1){
        	lruDigits=1;
        }else{
        	 lruDigits = (int) Math.ceil(Math.log(fact)/Math.log(2));
        }
       
        
	}
	public void setTagSize(){
		tagSz =   32- indexSz-offsetSz;
	
		
	}
	public void setOffsetSize(int log2blockSize){
		
		offsetSz = log2blockSize;
	}
	public void setIndexSize(){
		if(assoc==1){
			indexSz = (int) (Math.log(blockCount)/Math.log(2));
		}else{
			indexSz = (int) (Math.log(setTotal)/Math.log(2));
		}
		

	}
	public void setCacheSizes(int log2CacheSize){
		cacheSz = (int)Math.pow(2,log2CacheSize);
		cacheSzK = (int) (cacheSz/SZ);
	}
	public void setBlockSize(int log2blockSize){
		blockSz = (int)Math.pow(2,log2blockSize);
	}
	public void setBlockCount(){
		blockCount = cacheSz/blockSz;
	}
	
	
	/**
	 * function to set trace flag
	 * @param tf
	 * @throws Exception 
	 */
	public void setTraceFlag() throws Exception{
		if(traceflag.equalsIgnoreCase("on")){
			trace = true;
		}
		else if (traceflag.equalsIgnoreCase("off")){
			trace = false;
		}
		else{
			throw new Exception("Error in DMC: traceflag needs to be 'on' or 'off' ");
	
		}
	}
	
	public String[] getReadLines() throws IOException{
		
		
		String line;
		//String ret=null;
		String everything = null;
		BufferedReader textReader = null;
			
		
		try{
			FileReader fr = new FileReader(filePath);
			textReader = new BufferedReader(fr);
			StringBuilder sb = new StringBuilder();
			try {
				line = textReader.readLine();
				//System.out.println(line);
				while(line !=null){
					sb.append(line);
			        sb.append(System.lineSeparator());
			        line = textReader.readLine();
				}
				everything = sb.toString();
			} catch (IOException e) {
				// TODO Auto-generated catch block
				textReader.close();
				e.printStackTrace();
				
				throw e;
		
				
			}
			
			textReader.close();
			
		}catch(IOException e){
			e.printStackTrace();
			try {
				textReader.close();
			} catch (IOException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
				throw e1;
			}
		
		}
		//number access in number lines in file
		String[] data = everything.split("\n");
		
		return data;
	}
	
	
	public void cleanData(){
		for(int i = 0; i < data.length; i ++){
			
			data[i]=data[i].replaceAll("\\s+","");
			CharSequence ch = "0x";
			//System.out.println(data[i]);
			//if the address doesnt start with 0x--> dec convert to hex
			if(!(data[i].contains(ch))){
				
				data[i]=Integer.toHexString(Integer.parseInt(data[i]));
			}
			//else if the address is in hex remove 0x
			else{
				data[i]=data[i].replaceAll((String) ch,"");
			}
			
			//convert address to lower case
			data[i]=data[i].toLowerCase();
			//System.out.println(data[i]);
			accessCount = data.length;
			
		}
		
	}
	public static String[] getData(){
		return data;
	}
	public void setSetCount(){
		setTotal=blockCount/assoc;
	}
	public static int getSetCount(){
		return setTotal;
	}
	public static int getAssoc(){
		return assoc;
	}
	public static int getIndexBits(){
		return indexSz;
	}
	public static int getOffsetBits(){
		return offsetSz;
	}
	public static String getPolicy(){
		return policy;
	}
	
	public static int getTagBits(){
		return tagSz;
	}
	
	public static String getFilePath(){
		return filePath;
	}
	
	public static int getCacheSize(){
		return cacheSz;
	}
	
	public static int getCacheSizeK(){
		return cacheSzK;
	}
	
	public static int getBlockSize(){
		return blockSz;
	}
	
}
