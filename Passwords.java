import java.util.*;
import java.io.*;
import java.sql.*;
import java.security.*;

//PHP CODE TO ACCOMPANY THIS
/*

$passwordHash = bcrypt($password);
$encryptedHash = encrypt($passwordHash, $serverSideKey);
 ^ once you do this, store in database and check against it to verify!


*/

public class Passwords
{
	private static final Random RANDOM = new SecureRandom();
	private static final int ITERATIONS = 10000;
	private static final int KEY_LENGTH = 256;

	private Passwords() { /* blah */ }

	//generate 16 byte salt
	public static byte[] getNextSalt()
	{
		byte[] salt = new byte[16];
		RANDOM.nextBytes(salt);
		return salt;
	}

	//generate 16 byte pepper
	public static byte[] getNextPepper()
	{
		byte[] pepper = new byte[16];
		RANDOM.nextBytes(pepper);
		return pepper;
	}

	//salts, peppers, and hashes a password given the password (already peppered) and salt
	public static byte[] hash(char[] password, byte[] salt)
	{
		PBEKeySpec spec = new PBEKeySpec(password, salt, ITERATIONS, KEY_LENGTH);
		Arrays.fill(password, Character.MIN_VALUE);
		try
		{
			SecretKeyFactory skf = SecretKeyFactory.getInstance("PBKDF2WithHmacSHA1");
			return skf.generateSecret(spec).getEncoded();
		} catch (NoSuchAlgorithmException | InvalidKeySpecException e)
		{
			throw new AssertionError("Error while hashing a password: " + e.getMessage(), e);
		} finally
		{
			spec.clearPassword();
		}
	}

	//verify password and salt are correct
	public static boolean isExpectedPassword(char[] password, byte[] salt, byte[] expectedHash)
	{
    byte[] pwdHash = hash(password, salt);
    Arrays.fill(password, Character.MIN_VALUE);
    if (pwdHash.length != expectedHash.length) return false;
    for (int i = 0; i < pwdHash.length; i++)
    {
      if (pwdHash[i] != expectedHash[i]) return false;
    }
    return true;
  	}

  	//create a random password for the user
  	public static String generateRandomPassword(int length)
  	{
    	StringBuilder sb = new StringBuilder(length);
	    for (int i = 0; i < length; i++)
	    {
	      int c = RANDOM.nextInt(62);
	      if (c <= 9)
	      {
	        sb.append(String.valueOf(c));
	      } else if (c < 36) {
	        sb.append((char) ('a' + c - 10));
	      } else {
	        sb.append((char) ('A' + c - 36));
	      }
	    }
	return sb.toString();
    }
}