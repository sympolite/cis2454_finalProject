<%-- 
    Document   : header
    Created on : Dec 9, 2017, 10:58:54 AM
    Author     : Timothy Ian Anderson
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<p>Logged in as: <%out.println(request.getSession().getAttribute("custID"));%></p>
<hr />
