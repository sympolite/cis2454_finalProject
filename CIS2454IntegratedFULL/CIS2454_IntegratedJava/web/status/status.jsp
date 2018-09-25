<%-- 
    Timothy Ian Anderson
    Cis 2454
    Fall 2017 - Thurs. Afternoon
    Integrated Project
--%>

<%@page import = "java.util.ArrayList" %>
<%@page contentType = "text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Rewards Status</title>
        <style>
            table,th,td {
                border:1px solid black;
            }
        </style>
    </head>
    <body>
        <%@include file = '../footer/header.jsp'%>     
        <table>
            <tr>
                <th>Reward transaction date</th>
                <th>Bonus amount</th>
            </tr>
            <%  ArrayList<String[]> rewards = (ArrayList<String[]>)request.getAttribute("rewards");
                for (String[] reward : rewards) { %>
            <tr>
                <td><%out.println(reward[0]); %></td>
                <td><%out.println(reward[1]); %></td>
            </tr>
            <% } %>
        </table>
        
        <p>Current balance = <%out.println(request.getAttribute("total"));%></p>
        <%@include file = "../footer/footer.jsp" %>
    </body>
</html>
