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

public class NavigationServlet extends HttpServlet {

    
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
        String action = request.getParameter("action");
        String url;
        String custID;
        boolean isViaPHP = Boolean.getBoolean((String)request.getAttribute("viaPHP"));
        
        if (isViaPHP) {
            custID = (String)request.getAttribute("custID");
        }
        else {
            custID = (String)request.getSession().getAttribute("custID");
        }
        
        //this could simply be 'url = "/" + action + ".html";'
        //but the logic below is more obvious and failsafe
        switch (action) {
            case "reserve": //make reservations
                url = "/reserve/search_reservations.jsp";
                getServletContext().getRequestDispatcher(url).
                forward(request, response);
                break;
            case "payment": //make payment
                //put cust into GET
                response.sendRedirect("http://localhost/CIS2454IntegratedPHP/payment/payment.php?custID=" + custID);
                break;
            case "review":
                url = "/review/review.html"; //review reservations
                getServletContext().getRequestDispatcher(url).
                forward(request, response);
                break;
            case "status": //review rewards status
                url = "/RewardServlet"; 
                getServletContext().getRequestDispatcher(url).
                forward(request, response);
                break;
            case "financial": //review financial history
                //put cust into GET
                response.sendRedirect("http://localhost/CIS2454IntegratedPHP/report/view/report.php?custID=" + custID);
                break;
            default: //this should never be reached
                url = "/error.html";
                getServletContext().getRequestDispatcher(url).
                forward(request, response);
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
