/*
 * Timothy Ian Anderson
 * CIS 2454
 * Integrated Project
 */
package controller;

import java.io.IOException;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.sql.*;
import database.Database;
import java.util.ArrayList;
import java.util.Calendar;
import model.ReservationItem;
import java.util.GregorianCalendar;


public class SearchServlet extends HttpServlet {

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
        String url = "/reserve/reserve.jsp";
        String itemCode = request.getParameter("itemcode");
        int travelers = Integer.parseInt(request.getParameter("travelers"));
        String startDate = request.getParameter("startdate");
        String endDate = request.getParameter("enddate");
        
        String[] dateBits = startDate.split("-");
        
        Calendar now = new GregorianCalendar();
        Calendar earliestDay = new GregorianCalendar();
        Calendar selectedDay = new GregorianCalendar(
                Integer.parseInt(dateBits[0]),
                Integer.parseInt(dateBits[1]),
                Integer.parseInt(dateBits[2])
        );
        
        earliestDay.roll(Calendar.DAY_OF_YEAR, -120);
        
        if (selectedDay.before(earliestDay)) {
            url = "error.html";
        }
        else {
            ArrayList<ReservationItem> reservations = new ArrayList<>();
            String[][] colsAndVals = {
                {"RES_ITEMCODE", "'"+itemCode+"'"},
                {"RES_TRAVELERS", String.valueOf(travelers)},
                {"RES_STARTDATE", "'"+startDate+"'"},
                {"RES_ENDDATE", "'"+endDate+"'"}        
            };
            ResultSet rs = Database.select("travelitems", "TRAVITEM_ID", "'"+itemCode+"'");
            try {
               while (rs.next()) {
                    reservations.add(
                        new ReservationItem(
                            itemCode, 
                            rs.getString("TRAVITEM_TYPE"),
                            rs.getString("TRAVITEM_DESC"),
                            travelers,
                            startDate,
                            endDate
                        )
                    );
                }
            }
            catch (SQLException e) {
                
            }
        
        request.getSession().setAttribute("reservations", reservations);
        
        }
        
        getServletContext().getRequestDispatcher(url).forward(request, response);
        
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
