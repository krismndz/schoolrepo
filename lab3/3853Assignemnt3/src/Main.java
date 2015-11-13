
public class Main {

	public static void main(String[] args) {
		
		
		/**
		int arg1 = Integer.parseInt(args[0]);
		int arg2 = Integer.parseInt(args[1]);
		int arg3 = Integer.parseInt(args[2]);
		String arg4 = args[3];
		String arg5 = args[4];
		String arg6=args[5];
		CacheSim cache = new CacheSim(arg1, arg2,arg3,arg4, arg5, arg6);**/
		
		test();
	}
	
	public static void test(){
		int n = 15;
		int m = 6;
		int p = 2;
		String policy = "lru";
		String flag="on";
		String file = "C:/memory-small.txt";
		CacheSim cache = new CacheSim(n,m,p,policy,flag,file);
		
	}

}
