/*
 * Timothy Ian Anderson
 * CIS 2454 Thurs. Afternoon
 * Fall 2017
 * Integrated Project
 */
package controller;

import database.Database;
import model.ReservationItem;
import java.io.IOException;
import java.sql.*;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import java.util.Set;
import javax.servlet.ServletException;
import javax.servlet.http.Cookie;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class ReservationServlet extends HttpServlet {

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
        String action =  request.getParameter("sbmt");
        
        
        switch (action) {
            case "enter_new":
                {
                    String receiptIntoCookie = "";
                    Map<String, ReservationItem> receipt = new HashMap<>();
                    ArrayList<ReservationItem> cart = (ArrayList<ReservationItem>)request.getSession().getAttribute("cart");
                    //gets all selected items
                    for (String value : request.getParameterValues("selected")) {
                        for (ReservationItem item : cart) {
                            if (item.getItemCode().equals(value)) {
                                receipt.put(value, item);
                                receiptIntoCookie += (value + "%");
                            }
                        }                       
                    }       
                    request.setAttribute("receipt", receipt);
                    Cookie c = new Cookie("ReceiptCookie", receiptIntoCookie);
                    c.setMaxAge(3600 * 24); //expires after a day
                    c.setPath("/");         // allow entire app to access it
                    response.addCookie(c);
                    getServletContext().getRequestDispatcher("/reserve/reserve_selection.jsp").
                            forward(request, response);
                    break;
                }
            case "view_previous":
                {
                    Cookie c = null;
                    for (Cookie ck : request.getCookies()) {
                        if (ck.getName().equals("ReceiptCookie")) {
                            c = ck;
                        }
                    }
                    String[] checks = c.getValue().split("%");
                    for (String check: checks) {
                        request.setAttribute(check, "checked");
                    }       
                    getServletContext().getRequestDispatcher("/reserve/reserve.jsp").
                            forward(request, response);
                    break;
                }
            case "return_to_selection":
                {
                    getServletContext().getRequestDispatcher("/reserve/reserve.jsp").
                            forward(request, response);
                    break;
                }
            case "confirm_selection":
            {
                Map<String, ReservationItem> confirmed = 
                        (Map<String, ReservationItem>)request.getSession().getAttribute("confirmed");
                Set ks = confirmed.keySet();
                boolean insertOK = false;
                for (Object key : ks) {
                    int i = 0;
                    while (insertOK == false && i < 10) {
                    int rCode = (int)((Math.random() * 9999) + 1); //gives a number 1 thru 9999
                    String[][] dbItem = {
                              {"RES_ID","'R"+String.valueOf(rCode)+"'"}, 
                                  {"RES_ITEMID","'"+(String)key+"'"},
                                  {"RES_STATUS","'CONFIRMED'"},
                                  {"RES_TRAVELERS",String.valueOf(confirmed.get((String)key).getTravelers())},
                                  {"RES_STARTDATE","'"+confirmed.get((String)key).getStartDate()+"'"},
                                  {"RES_ENDDATE","'"+confirmed.get((String)key).getEndDate()+"'"},
                                  {"RES_CUSTID","'"+request.getSession().getAttribute("custID")+"'"}
                          };
                        insertOK = Database.insert("reservations",dbItem);
                        i++;
                    } 
                }
                 getServletContext().getRequestDispatcher("/reserve/thankyou.jsp").
                            forward(request, response);                          
                break;
            }
        //you should not get here
            default:
                break;
        }
                
        
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
        doGet(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }

}
