<%-- 
    Timothy Ian Anderson
    Cis 2454
    Fall 2017 - Thurs. Afternoon
    Integrated Project
--%>

<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<%@page import="java.util.ArrayList"%>
<%@page import="java.util.Date"%>
<%@page import="java.text.SimpleDateFormat"%>
<%@page import="java.sql.*"%>
<%@ page import = "model.ReservationItem"%>
<%@page import = "database.Database" %>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Select Reservations</title>
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <%@include file = '../footer/header.jsp'%>        
        <% ArrayList<ReservationItem> cart = 
                (ArrayList<ReservationItem>)request.getSession().getAttribute("reservations");
        
        %>
        <form action="ReservationServlet" method ="get">
            <table>
                
                <tr>
                    <th>Item Code</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Travelers</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Select</th>
                </tr>
                <% for (int i = 0; i < cart.size(); i++) {
                String rco = cart.get(i).getItemCode();%>
                    <tr>
                        <td><%out.println(rco);%></td>
                        <td><%out.println(cart.get(i).getType());%></td>
                        <td><%out.println(cart.get(i).getDescription());%></td>
                        <td><%out.println(cart.get(i).getTravelers());%></td>
                        <td><%out.println(cart.get(i).getStartDate());%></td>
                        <td><%out.println(cart.get(i).getEndDate());%></td>
                        <td><input type="checkbox" name = "selected" value = <%out.println(rco);%> <%out.println(request.getAttribute(rco)); %> /> </td>
                    </tr>
                    <% } %>
                    <% request.getSession().setAttribute("cart", cart); %>
                
            </table>
            <input type="submit" name = "sbmt" value = "enter_new">
            <input type="submit" name = "sbmt" value = "view_previous">
        </form>
            <%@include file = '../footer/footer.jsp'%>
    </body>
</html>
