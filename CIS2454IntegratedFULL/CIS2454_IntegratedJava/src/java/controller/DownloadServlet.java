/*
 * Timothy Ian Anderson
 * CIS 2454
 * Integrated Project
 */
package controller;

import database.Database;
import java.io.IOException;
import java.io.OutputStream;
import java.io.PrintWriter;
import java.sql.ResultSet;
import java.sql.SQLException;
import javax.servlet.ServletException;
import javax.servlet.ServletOutputStream;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import org.apache.poi.hssf.usermodel.HSSFWorkbook;
import org.apache.poi.ss.usermodel.*;

public class DownloadServlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        String headerName = request.getHeader("x-requested-with");
        Object type = request.getParameter("requestType");
        
        
        if (type.equals("spreadsheet")) {
            Workbook workbook = new HSSFWorkbook();
            Sheet sheet = workbook.createSheet("Confirmed Reservations");
            Row row0 = sheet.createRow(0);
            row0.createCell(0).setCellValue("CONFIRMED RESERVATIONS FOR JOSEPH SCHMOE");
            Row row1 = sheet.createRow(1);
            row1.createCell(0).setCellValue("RES_ID");
            row1.createCell(1).setCellValue("RES_CUSTID");
            row1.createCell(2).setCellValue("RES_ITEMID");
            row1.createCell(3).setCellValue("RES_ITEMTYPE");
            row1.createCell(4).setCellValue("RES_ITEMDESC");
            row1.createCell(5).setCellValue("RES_STARTDATE");
            row1.createCell(6).setCellValue("RES_ENDDATE");
            row1.createCell(7).setCellValue("RES_COST");
        
            ResultSet res = Database.select("reservations","CUST_ID",(String)request.getSession().getAttribute("custID"));
            int i = 2;
            try {
               while (res.next()) {
                    ResultSet itm = Database.select("travelitems","TRAVITEM_ID",res.getString("RES_ITEMID"));
                    Row row = sheet.createRow(i);
                    row.createCell(0).setCellValue(res.getString("RES_ID"));
                    row.createCell(2).setCellValue(res.getString("RES_ITEMID"));
                    row.createCell(3).setCellValue(itm.getString("TRAVITEM_TYPE"));
                    row.createCell(4).setCellValue(itm.getString("TRAVITEM_DESC"));
                    row.createCell(5).setCellValue(res.getString("RES_STARTDATE"));
                    row.createCell(6).setCellValue(res.getString("RES_ENDDATE"));
                    row.createCell(7).setCellValue("$" + res.getString("TRAVITEM_COST"));
                    i++;
                } 
            }
            catch (SQLException e) {
                Row row = sheet.createRow(i+1);
                row.createCell(0).setCellValue("INVALID DATA");
            }
            
            response.setHeader("content-disposition", "attachment; filename=ReservationRecord.xls");
            response.setHeader("cache-control", "no-cache");
            try (OutputStream out = response.getOutputStream()) {
                workbook.write(out);
            }
        }
        else if (type.equals("pdf")) {
            response.setHeader("content-disposition", "attachment; filename=TermsOfService.rtf");
            response.setHeader("cache-control", "no-cache");
        }
        else if (type.equals("ajax") || headerName != null) {
            ServletOutputStream out = response.getOutputStream();
            out.print("Ajax Request Detected. Success!");
            out.flush();
        }
        else {
            //pass
        }
        
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
