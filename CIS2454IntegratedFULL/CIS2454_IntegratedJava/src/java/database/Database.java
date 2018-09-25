/*
 * Timothy Ian Anderson
 * CIS 2454
 * Integrated Project
 */
package database;
import java.sql.*;


public class Database {
    static String myDriver = "com.mysql.jdbc.Driver";
    static String myUrl = "jdbc:mysql://localhost:3306/codingex6db";
    
    
    public static ResultSet select(String table) {
        ResultSet rs = null;
        try {
            Class.forName(myDriver);
            Connection conn = DriverManager.getConnection(myUrl, "root", "");
            String query = "SELECT * FROM " + table;
            Statement st = conn.createStatement();
            rs = st.executeQuery(query);
            
        }
        catch (ClassNotFoundException | SQLException e) {
            
        }
        return rs;
    }
    
    public static ResultSet select(String table, String column, String value) {
        ResultSet rs = null;
        try {
            Class.forName(myDriver);
            Connection conn = DriverManager.getConnection(myUrl, "root", "");
            String query = "SELECT * FROM " + table + " WHERE " + column + " = " + value + "";
            Statement st = conn.createStatement();
            rs = st.executeQuery(query);
            
        }
        catch (ClassNotFoundException e) {
            System.out.println("Driver was not found: " + e.toString());
        }
            
        catch (SQLException e) {
            System.out.println("SQL Failed: " + e.getSQLState());
        }
        return rs;
    }
    
    public static ResultSet select_and(String table, String[][] colsAndVals) {
        ResultSet rs = null;
        try {
            Class.forName(myDriver);
            Connection conn = DriverManager.getConnection(myUrl, "root", "");
            String query = "SELECT * FROM " + table + " WHERE ";
            String where = "";
            for (int i = 0; i < colsAndVals.length; i++) {
                where += (colsAndVals[i][0] + " = " + colsAndVals[i][1]);
                if (i < colsAndVals.length-1) where += " AND ";
            }
            Statement st = conn.createStatement();
            rs = st.executeQuery(query);
            
        }
        catch (ClassNotFoundException | SQLException e) {
            
        }
        return rs;
    }
    
    public static boolean insert(String table, String[][] colsAndValues) {
        boolean insertOK;
        String query = "";
        try {
            Class.forName(myDriver);
            Connection conn = DriverManager.getConnection(myUrl, "root", "");
            query = "INSERT INTO " + table;
            String columns = "(";
            String colVals = "(";
            for (int i = 0; i < colsAndValues.length; i++) {
                columns += i < colsAndValues.length-1 ? colsAndValues[i][0] + ", " : colsAndValues[i][0];
                colVals += i < colsAndValues.length-1 ? colsAndValues[i][1] + ", " : colsAndValues[i][1];
            }
            columns += ")";
            colVals += ")";
            
            query += (" WHERE " + columns + " VALUES " + colVals);
            Statement st = conn.createStatement();
            st.executeUpdate(query);
            insertOK = true;
        }
        catch (SQLException e) {
            System.out.println("Illegal query: " + query);
            insertOK = false;
        }
        catch (ClassNotFoundException e) {
            insertOK = false;
        }
        return insertOK;
    }
    public static boolean update(String table, String[][] colsAndValues) {
        boolean updateOK;
        try {
            Class.forName(myDriver);
            Connection conn = DriverManager.getConnection(myUrl, "root", "");
            String query = "UPDATE" + table + " SET ";
            String where = " WHERE " + colsAndValues[0][0] + " = " + colsAndValues[0][0];
            String columns = "";
            for (int i = 0; i < colsAndValues.length; i++) {
                if (i < colsAndValues.length-1) {
                    columns += (colsAndValues[i][0] + " = " + colsAndValues[i][1] + ", ");
                }
                else {
                    columns += (colsAndValues[i][0] + " = " + colsAndValues[i][1]);
                }
            }
            query += columns + where;
            Statement st = conn.createStatement();
            st.executeUpdate(query);
            updateOK = true;
        }
        catch (ClassNotFoundException | SQLException e) {
            updateOK = false;
        }
        return updateOK;
    }
    public static boolean delete(String table, String pkey, String value) {
        boolean deleteOK;
        try {
            Class.forName(myDriver);
            Connection conn = DriverManager.getConnection(myUrl, "root", "");
            String query = "DELETE FROM " + table + " WHERE " + pkey + " = " + value;
            Statement st = conn.createStatement();
            st.executeQuery(query);   
            deleteOK = true;
        }
        catch (ClassNotFoundException | SQLException e) {
            deleteOK = false;
        }
        return deleteOK;
    }
    
}
