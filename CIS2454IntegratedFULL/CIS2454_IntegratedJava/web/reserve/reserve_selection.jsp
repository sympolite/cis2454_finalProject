<%-- 
    Timothy Ian Anderson
    Cis 2454
    Fall 2017 - Thurs. Afternoon
    Integrated Project
--%>

<%@page import="java.util.Map.Entry"%>
<%@page import="java.util.Map"%>
<%@page import="model.ReservationItem"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Selected Reservations</title>
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <%@include file = '../footer/header.jsp'%>     
        <form action="ReservationServlet" method ="get">
         <table>
                <tr>
                    <th>Item Code</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Travelers</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
                <% 
                    Map<String, ReservationItem> items = 
                            (Map<String, ReservationItem>) request.getAttribute("receipt");
                                    
                for(Entry<String, ReservationItem> item : items.entrySet()) {
                %>
                <tr>
                    <td><%out.print(item.getValue().getItemCode());%></td>
                    <td><%out.print(item.getValue().getType());%></td>
                    <td><%out.print(item.getValue().getDescription());%></td>
                    <td><%out.print(item.getValue().getTravelers());%></td>
                    <td><%out.print(item.getValue().getStartDate());%></td>
                    <td><%out.print(item.getValue().getEndDate());%></td>
                </tr>
                <%}request.getSession().setAttribute("confirmed", items);%>
            </table>
            <input type="submit" name = "sbmt" value = "return_to_selection">
            <input type="submit" name = "sbmt" value = "confirm_selection">
            </form>
            <%@include file = '../footer/footer.jsp'%>
    </body>
</html>
