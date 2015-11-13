import java.io.BufferedReader;
import java.util.LinkedList;
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
public class SAC {
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
	public int sets;
	public int assoc;
	public String policy;
	public int setCount;
//	public String everything;
	public static LinkedList<String> activeQueue;
	public SAC(int log2CacheSize, int log2blockSize,int p,String pol, String tf, String fp){
	
		tagBinaryList = new ArrayList<String>();
		indexBinaryList = new ArrayList<String>();
		offsetBinaryList = new ArrayList<String>();
		misses = 0;
		hits = 0;

		traceflag = tf;
		out = false;
		last = 0;
		currlast = 0;
		setCount=CacheSim.getSetCount();
		policy=CacheSim.getPolicy();
		assoc = CacheSim.getAssoc();
		offsetSz=CacheSim.getOffsetBits();
		tagSz=CacheSim.getTagBits();
		indexSz=CacheSim.getIndexBits();
		filePath =CacheSim.getFilePath();
		data=CacheSim.getData();
		this.initializeCache();
		
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
}
