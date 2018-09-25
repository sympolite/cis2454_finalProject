<%-- 
    Document   : customeractions
    Created on : Dec 9, 2017, 11:08:40 AM
    Author     : Timothy Ian Anderson
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <title>J</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <%@include file = '../footer/header.jsp' %>
        <h1>Select an action from the list below</h1>
        <a href="NavigationServlet?action=reserve">Make reservations</a><br>
        <a href="NavigationServlet?action=payment">Make a payment</a><br>
        <a href="NavigationServlet?action=review">Review confirmed reservations</a><br>
        <a href="NavigationServlet?action=status">Review rewards and status history</a><br>
        <a href ="NavigationServlet?action=financial">Review financial history</a>
    </body>
</html>