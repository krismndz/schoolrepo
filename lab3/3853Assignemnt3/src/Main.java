
public class Main {

	public static void main(String[] args) {
		
		
		/**int arg1 = Integer.parseInt(args[0]);
		int arg2 = Integer.parseInt(args[1]);
		int arg3 = Integer.parseInt(args[2]);
		String arg4 = args[3];
		String arg5 = args[4];
		String arg6=args[5];
		CacheSim cache = new CacheSim(arg1, arg2,arg3,arg4, arg5, arg6);	**/
		test();
	}
	
	public static void test(){
		int n = 16;
		int m = 6;
		int p = 2;
		String policy = "fifo";
		String flag="on";
		String file = "/Users/kristinmendoza/git/schoolrepo/lab3/3853Assignemnt3/src/testfile2.txt";
		CacheSim cache = new CacheSim(n,m,p,policy,flag,file);
		
	}

}
