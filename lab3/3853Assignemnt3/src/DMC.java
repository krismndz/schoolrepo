import java.math.*;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.lang.*;
import java.io.BufferedReader;
public class DMC {
	public static int SZ =1024;
	public int cacheSzK;
	public int cacheSz;
	public int blockSz;
	public boolean trace;
	public int tagSz;
	public int indexSz;
	public int offsetSz;
	public static int blocksCount;
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
	public String filePath;
	public String[] data;
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
	public ArrayList<String[][]>addedTags;

//	public String everything;
	public DMC(int log2CacheSize, int log2blockSize, String tf, String fp){
		addedTags=new ArrayList<String[][]>();
		tagBinaryList = new ArrayList<String>();
		indexBinaryList = new ArrayList<String>();
		offsetBinaryList = new ArrayList<String>();
		misses = 0;
		hits = 0;
		filePath = fp;
		traceflag = tf;
		out = false;
		last = 0;
		currlast = 0;
		if(log2CacheSize <= 0){
			System.err.println("Error in DMC: cache size must be greater than 0 ");
			return;
		}
		
		//set cache size, block size, cache size k
		cacheSz = (int)Math.pow(2,log2CacheSize);
		cacheSzK = (int) (cacheSz/SZ);
		blockSz = (int)Math.pow(2,log2blockSize);
		
		
		blocksCount = cacheSz/blockSz;
		
		
		/**
		 * Because this is a direct mapped cache, the number of bits for: 
		 * index = log2(cacheSzK*1024/blockSz)
		 * offset = log2blockSize
		 * tag = 32- indexSz-offsetSz
		 * **/
		//---STOP ON CACHESIM.java--------------------------------------------------------
		this.setIndexSize();
		this.setOffsetSize(log2blockSize);
		this.setTagSize();
	
		/**indexSz = (int) (Math.log(blocksCount)/Math.log(2));
		offsetSz = log2blockSize;
		tagSz =   32- indexSz-offsetSz;
		**/
	
		
		//set trace flag and check parameters
		try{
			this.setTraceFlag();
			this.checkParams();
		}catch(Exception e){
			System.out.println(e.getMessage());
			return;
		}
		
		
		
		//read file and get lines
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
		
		//initialize cache
		this.initializeCache();
	
	
		String ADDR = "ADDR";
		String TAG = "TAG";
		if(trace == true){
			
				System.out.println("address	tag	set	h/m	hits	misses	accesses	miss ratio	tags");
			
			//System.out.println("ADDR    TAG    BLK    CTAG    VAL    HITS    MISSES    ACCESS    MISSRATIO");

		}
		
	
		
		//convert addresses to binary and separate into 
		//desired parts
		
		
		for(int i = 0; i < data.length; i ++){
			str = data[i].toCharArray();
		
			String time = Integer.toString(i+1);
			
			//convert hex string to binary string of length 32
			String bin=Integer.toBinaryString(Integer.parseInt(data[i], 16));
			int n = bin.length();
			int insert = 32 - n;
			char [] ins = new char[insert];
			Arrays.fill(ins, '0');
			
			binaryString = new String(ins)+bin;
		
			
			//set binary values into indexbinary, tagbinary and offsetbinary
			this.setBinaryValues();
			
			//set values in decimal 
			this.setDecimalValues();
	
			//set values in hex
			this.setHexValues();
			
			//add binary values to array list
			tagBinaryList.add(tagbinary);
			indexBinaryList.add(indexbinary);
			offsetBinaryList.add(offsetbinary);
			
		
			/**
			 * to find if this address is in the cache, look up the 
			 * entry at the index
			 */
			
	
			try{
				if(cache[indexdec][0].equals(taghex)){
					hits ++;
					hm= true;
					
					
				}else{
					
					misses ++;
					hm = false;
					
				} 
			}
			catch (ArrayIndexOutOfBoundsException e){
				out = true;
				misses ++;
				
				hm = false;
				
				
			}
			
			missratio = ((double)misses/(i+1));
			
			if(trace){
				System.out.printf("%4s",data[i]);
				System.out.printf("%6s",taghex);
				System.out.printf("%8d",indexdec+1);
				if(hm){
					System.out.printf("%8s","HIT");
				}else{
					System.out.printf("%8s","MISS");
				}
				//System.out.printf("%8s",indexhex);
			
				/**try{
					if(!cache[indexdec][0].equals("-1")){
						System.out.printf("%8s",cache[indexdec][0]);
					}else{
						System.out.printf("        ");
	
					}
				}catch(ArrayIndexOutOfBoundsException e){
					System.out.printf("        ");

				}**/
				

				System.out.printf("%9d",hits);
				System.out.printf("%10d",misses);
				System.out.printf("%10d",i+1);
				System.out.printf("%18s",String.format("%.8g",missratio));
				System.out.print("      ");
				if(!cache[indexdec][1].equals("-1")){
					System.out.printf("%s(%s)",cache[indexdec][0],cache[indexdec][1]);
				}
				System.out.println();
			}
			
		
		try{

			cache[indexdec][0]= taghex;
			cache[indexdec][1]= time;
			if(indexdec>last ){
				last = indexdec;
				//System.out.println("Index dec"+ Integer.toString(indexdec)+ "last: "+ Integer.toString(last));
			}
			
		}catch (ArrayIndexOutOfBoundsException e){
			//extend cache buffer and initialize when necessay
			String [][]tmpcache =new String[indexdec+1][2];
			
			for(int t = 0; t <= last; t++){
				for (int j = 0; j < 2; j++){
					//System.out.println("t: "+Integer.toString(t));
					tmpcache[t][j]=cache[t][j];
				}
			}
			for(int t = last+1; t <= indexdec; t++){
				for (int j = 0; j < 2; j++){
					
					tmpcache[t][j]="-1";
				}
			}
			//System.out.println("out");
			cache = tmpcache;
			//set appropriate tag 
			cache[indexdec][0]= taghex;
			cache[indexdec][1]= time;
		}
		
		
		
		}
		
		
		System.out.println("Kristin Dominique Mendoza");
		System.out.println(Integer.toString(log2CacheSize)+ " "+Integer.toString(log2blockSize)+" "+Integer.toString(0)+ " "+CacheSim.getPolicy()+" "+traceflag+" "+ filePath);
		System.out.println("memory accesses: "+Integer.toString(accessCount));
		System.out.println("hits: "+Integer.toString(hits));
		System.out.println("misses: "+Integer.toString(misses));
		System.out.println("miss ratio: "+String.format("%.8g",missratio));
		
	}
	
	
	
	/**
	 * function to check parameters for validity
	 * @throws Exception
	 */
	
	public void printParams(int i){
		
	}
	public void checkParams() throws Exception{
		if(blockSz> cacheSz){
			throw new Exception("Error in DMC: block size cannot be bigger than cache size");
			//return;
		}
		
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
	
	
	/**
	 * funtion to read file lines
	 * @return
	 * @throws IOException
	 */
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
	
	public void initializeCache(){
	//cache= new String[accessCount][2];
		int n = 80;
		//int n = 999999;
		/**if(n < accessCount){
			//n = accessCount;
		}**/
		cache = new String[n][2];
		
		//for(int i = 0; i < accessCount; i++){
		for(int i = 0; i < n; i++){
			for (int j = 0; j < 2; j++){
				
				cache[i][j]="-1";
			}
		}
	}
	public void setTagSize(){
		tagSz =   32- indexSz-offsetSz;
	
		
	}
	
	public void setIndexSize(){
		indexSz = (int) (Math.log(blocksCount)/Math.log(2));

	}
	public void setOffsetSize(int log2blockSize){
	
		offsetSz = log2blockSize;
	}
	
	public void checkSizes(){
		/**System.out.println("Tag Size: "+Integer.toString(tagSz));
		System.out.println("Index Size: "+Integer.toString(indexSz));
		System.out.println("Offset Size :"+Integer.toString(offsetSz));**/
		
	}
	public void setBinaryValues(){
		tagbinary = binaryString.substring(0,tagSz);
		if(indexSz == 0){
			indexbinary= "0";
		}else{
			indexbinary = binaryString.substring(tagSz,tagSz+indexSz);
		}
		offsetbinary = binaryString.substring(tagSz+indexSz,binaryString.length());
		
	}
	
	public String[] decToString(){
		String[] ret= {Integer.toString(tagdec),Integer.toString(indexdec),Integer.toString(offsetdec)};
		return ret;
	}
	
	public void setDecimalValues(){
		tagdec = Integer.parseInt(tagbinary,2);
		indexdec = Integer.parseInt(indexbinary,2);
		offsetdec = Integer.parseInt(offsetbinary,2);
	}
	
	public void setHexValues(){
		taghex = Integer.toString(tagdec,16);
		indexhex = Integer.toString(indexdec,16);
		offsethex = Integer.toString(offsetdec,16);
	}
	
	public static void printBlockCount(){
		System.out.println("Number Blocks: "+Integer.toString(blocksCount));
	}
}
