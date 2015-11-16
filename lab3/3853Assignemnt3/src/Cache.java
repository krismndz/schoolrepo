import java.io.BufferedReader;
import java.util.LinkedList;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.math.*;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Arrays;
import java.lang.*;
import java.io.BufferedReader;
public class Cache {
	public static int SZ =1024;
	public int cacheSzK;
	public int cacheSz;
	public int blockSz;
	public boolean trace;
	public int tagSz;
	public int indexSz;
	public int offsetSz;
	public int blocksCount;
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
	//public String [][]cache;
	public String tagbinary;
	public String indexbinary;
	public String offsetbinary;
public int log2CacheSz;
public int log2blockSz;
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
	public int sets;
	public int assoc;
	public String policy;
	public int setCount;
//	public String everything;
	public int pval;
	public static LinkedList<String> activeQueue;
	public static ArrayList<LinkedList<String[][]>>cache;
	public Cache(int log2CacheSize, int log2blockSize,int p,String pol, String tf, String fp){
		log2CacheSz=log2CacheSize;
		log2blockSz=log2blockSize;
		cache=new ArrayList<LinkedList<String[][]>>();
		tagBinaryList = new ArrayList<String>();
		indexBinaryList = new ArrayList<String>();
		offsetBinaryList = new ArrayList<String>();
		misses = 0;
		hits = 0;

		traceflag = tf;
		out = false;
		pval=p;
		last = 0;
		currlast = 0;
		setCount=CacheSim.getSetCount();
		policy=CacheSim.getPolicy();
		assoc = CacheSim.getAssoc();
		offsetSz=CacheSim.getOffsetBits();
		tagSz=CacheSim.getTagBits();
		indexSz=CacheSim.getIndexBits();
		trace=CacheSim.getTrace();
		
		if(trace){
			System.out.println("address	tag	set	h/m	hits	misses	accesses	miss ratio	tags");
		}
		filePath =CacheSim.getFilePath();
		data=CacheSim.getData();
		accessCount=data.length;
		if(indexSz==0){
			this.initializeFullyAssociativeCache();
		}else{
			this.initializeCache();
		}
		
		if(indexSz==0){
		//	System.out.println("Index size is 0");
			this.runFullyAssociativeSimulatio();
		}else{
			this.runSimulation();
		}
		
		this.printEnd();
	}
	
	public void runFullyAssociativeSimulatio(){
		for(int i =0; i < data.length;i++){
			
			int time = i+1;
			str = data[i].toCharArray();
		
			
			
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
		
			offsetBinaryList.add(offsetbinary);
			String address = tagbinary;
		//	System.out.println(tagbinary+" Length:"+tagbinary.length());
			
			int addressInt = Integer.parseInt(address,2);
			
			//int setNum=addressInt%setCount;
			int setNum=0;
		//	System.out.println("Set count:" +Integer.toString(setCount));
			boolean hm=false;
			boolean hasEmpty=false;
			for(int j = 0; j < setCount; j++){

				if(cache.get(j).get(0)[0][0].equals(taghex)){
					if(policy.equals("lru")){
						cache.get(j).get(0)[0][1]=Integer.toString(time);
					}
					
					hm=true;
					//setNum=j;
					break;
				}
			}
			if(hm==false){
				misses++;
				for(int j =0; j < setCount; j++){
					if(cache.get(j).get(0)[0][0].equals("-1")){
						hasEmpty=true;
						cache.get(j).get(0)[0][0]=taghex;
						cache.get(j).get(0)[0][1]=Integer.toString(time);
						//setNum=j;
						break;
					}
				}
				if(hasEmpty==false){
					int min =9999999;
					int replace=-1;
					for(int j = 0; j < setCount; j++){
	
						if(Integer.parseInt(cache.get(j).get(0)[0][1])<min){
							min=Integer.parseInt(cache.get(j).get(0)[0][1]);
							replace = j;
						}
					}
				
					cache.get(replace).get(0)[0][0]=taghex;
					cache.get(replace).get(0)[0][1]=Integer.toString(time);
				
				}
			}else{
				hits++;
			}
			missratio=(((double)misses)/(double)(i+1));
	
			if(trace){
				ArrayList<Integer>sortme=new ArrayList<Integer>();
				
				ArrayList<LinkedList<String[][]>>sorted=new ArrayList<LinkedList<String[][]>>();
				System.out.printf("%4s",data[i]);
				System.out.printf("%6s",taghex);
				System.out.printf("%8d",setNum);
				if(hm){
					System.out.printf("%8s","hit");
				}else{
					System.out.printf("%8s","miss");
				}
				
				

				System.out.printf("%9d",hits);
				System.out.printf("%10d",misses);
				System.out.printf("%10d",i+1);
				System.out.printf("%18s",String.format("%.8g",missratio));
				System.out.print("      ");
				
				for(int j =0; j < setCount; j++){
					if(!cache.get(j).get(0)[0][0].equals("-1")){
					
						int decval = hex2decimal(cache.get(j).get(0)[0][0]);
						Integer[][]add=new Integer[1][2];
						add[0][0]=decval;
						add[0][1]=j;
						//sorted.add(add);
						sortme.add(decval);
					}
				}
				Collections.sort(sortme);
				for(int j = 0; j < sortme.size(); j++){
					for(int k=0; k<setCount; k++){
						if(!cache.get(j).get(0)[0][0].equals("-1")){
							if(hex2decimal(cache.get(k).get(0)[0][0])==sortme.get(j)){
								sorted.add(cache.get(k));
							}	
						}
					}
					
				}
				for(int j =0; j < sorted.size(); j++){
					if(j>0){
						System.out.print(", ");
					}
					
					System.out.printf("%s(%s)",sorted.get(j).get(0)[0][0],sorted.get(j).get(0)[0][1]);
				}
				System.out.println();
				//System.out.println("address	tag	set	h/m	hits	misses	accesses	miss ratio	tags");
			}
		}
	}
	
	public void runSimulation(){
		for(int i =0; i < data.length;i++){
		
			int time = i+1;
			str = data[i].toCharArray();
		
			
			
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
			String address = tagbinary+indexbinary;
			
			int addressInt = Integer.parseInt(address,2);
			
			int setNum=addressInt%setCount;
		
			boolean hm=false;
			boolean hasEmpty=false;
			for(int j = 0; j < assoc; j++){

				if(cache.get(setNum).get(j)[0][0].equals(taghex)){
					if(policy.equals("lru")){
						cache.get(setNum).get(j)[0][1]=Integer.toString(time);
					}
					
					hm=true;
					break;
				}
			}
			if(hm==false){
				misses++;
				for(int j =0; j < assoc; j++){
					if(cache.get(setNum).get(j)[0][0].equals("-1")){
						hasEmpty=true;
						cache.get(setNum).get(j)[0][0]=taghex;
						cache.get(setNum).get(j)[0][1]=Integer.toString(time);
						break;
					}
				}
				if(hasEmpty==false){
					int min =9999999;
					int replace=-1;
					for(int j = 0; j < assoc; j++){
	
						if(Integer.parseInt(cache.get(setNum).get(j)[0][1])<min){
							min=Integer.parseInt(cache.get(setNum).get(j)[0][1]);
							replace = j;
						}
					}
					cache.get(setNum).get(replace)[0][0]=taghex;
					cache.get(setNum).get(replace)[0][1]=Integer.toString(time);
				
				}
			}else{
				hits++;
			}
			missratio=(((double)misses)/(double)(i+1));
	
			if(trace){
				
ArrayList<Integer>sortme=new ArrayList<Integer>();
				
				ArrayList<String[][]>sorted=new ArrayList<String[][]>();
				System.out.printf("%4s",data[i]);
				System.out.printf("%6s",taghex);
				System.out.printf("%8d",setNum);
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
				/**for(int j =0; j < assoc; j++){
					if(!cache.get(setNum).get(j)[0][0].equals("-1")){
						if(j>0){
							System.out.print(", ");
						}
						System.out.printf("%s(%s)",cache.get(setNum).get(j)[0][0],cache.get(setNum).get(j)[0][1]);
						
					}
				}**/
				
				for(int j =0; j <assoc; j++){
					if(!cache.get(setNum).get(j)[0][0].equals("-1")){
					
						int decval = hex2decimal(cache.get(setNum).get(j)[0][0]);
					
						sortme.add(decval);
					}
				}
				Collections.sort(sortme);
				for(int j = 0; j < sortme.size(); j++){
					for(int k=0; k<assoc; k++){
						if(!cache.get(setNum).get(k)[0][0].equals("-1")){
							if(hex2decimal(cache.get(setNum).get(k)[0][0])==sortme.get(j)){
								sorted.add(cache.get(setNum).get(k));
							}	
						}
					}
					
				}
				for(int j =0; j < sorted.size(); j++){
					if(j>0){
						System.out.print(", ");
					}
					
					System.out.printf("%s(%s)",sorted.get(j)[0][0],sorted.get(j)[0][1]);
				}
				System.out.println();
				//System.out.println("address	tag	set	h/m	hits	misses	accesses	miss ratio	tags");
			}
			
		}
	}
	public void printEnd(){
		/**System.out.println("Hits: "+Integer.toString(hits));
		System.out.println("Misses: "+Integer.toString(misses));
	
		System.out.println("Access Count: "+ Integer.toString(accessCount));
		System.out.printf("Miss Ratio: %s\n",String.format("%.8g",missratio));**/
		System.out.println("Kristin Dominique Mendoza");
		System.out.println(Integer.toString(log2CacheSz)+ " "+Integer.toString(log2blockSz)+" "+Integer.toString(pval)+ " "+policy+" "+traceflag+" "+ filePath);
		System.out.println("memory accesses: "+Integer.toString(accessCount));
		System.out.println("hits: "+Integer.toString(hits));
		System.out.println("misses: "+Integer.toString(misses));
		System.out.println("miss ratio: "+String.format("%.8g",missratio));
		
	}
	
	public void initializeFullyAssociativeCache(){
		
		int n = 80;
		//int n = 999999;
		/**if(n < accessCount){
			//n = accessCount;
		}**/
		
		
		//for(int i = 0; i < accessCount; i++){
		for(int i = 0; i < setCount; i++){
			LinkedList<String[][]>set = new LinkedList<String[][]>();
	
				String[][] block= new String[1][2];
				for (int j = 0; j < 2; j++){
					
					block[0][j]="-1";
				}
				set.add(block);
			
			cache.add(set);
		}
	}
	public void initializeCache(){
	//cache= new String[accessCount][2];
		
		int n = 80;
		//int n = 999999;
		/**if(n < accessCount){
			//n = accessCount;
		}**/
		
		
		//for(int i = 0; i < accessCount; i++){
		for(int i = 0; i < setCount; i++){
			LinkedList<String[][]>set = new LinkedList<String[][]>();
			for(int k=0;k<assoc; k++){	
				String[][] block= new String[1][2];
				for (int j = 0; j < 2; j++){
					
					block[0][j]="-1";
				}
				set.add(block);
			}
			cache.add(set);
		}
	}

	public void setBinaryValues(){
		//System.out.println("tag size "+Integer.toString(tagSz));
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
	  public static int hex2decimal(String s) {
	        String digits = "0123456789ABCDEF";
	        s = s.toUpperCase();
	        int val = 0;
	        for (int i = 0; i < s.length(); i++) {
	            char c = s.charAt(i);
	            int d = digits.indexOf(c);
	            val = 16*val + d;
	        }
	        return val;
	    }
	public void setDecimalValues(){
		tagdec = Integer.parseInt(tagbinary,2);
		if(indexSz!=0){
			indexdec = Integer.parseInt(indexbinary,2);
		}

		offsetdec = Integer.parseInt(offsetbinary,2);
	}
	
	public void setHexValues(){
		taghex = Integer.toString(tagdec,16);
		if(indexSz!=0){
			indexhex = Integer.toString(indexdec,16);
		}
	
		offsethex = Integer.toString(offsetdec,16);
	}
	public void setLru(){
		
	}
}
