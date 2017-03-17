 public class Hack {

        public static void main(String[] args) throws IOException {

           InputStream inputStream = new FileInputStream("test.txt");

           AISInputStreamReader streamReader= new AISInputStreamReader(inputStream,
                    aisMessage -> printMessage(aisMessage))
           );

           streamReader.run();
        }

        void printMessage(String aisMessage){
          System.out.println(aisMessage);
        }

    }