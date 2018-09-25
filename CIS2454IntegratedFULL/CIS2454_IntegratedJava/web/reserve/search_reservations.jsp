<%-- 
    Timothy Ian Anderson
    Cis 2454
    Fall 2017 - Thurs. Afternoon
    Integrated Project
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Search reservations</title>
    </head>
    <body>
        <%@include file = '../footer/header.jsp'%>     
        <h1>Search for items:</h1>
        <form action="SearchServlet" method ="POST">
            <table>
                <tr>
                    <td>Item code:</td>
                    <td><input type="text" name = "itemcode"/></td>
                </tr>
                <tr>
                    <td>Number of travelers:</td>
                    <td><input type="number" min="1" name="travelers"/></td>
                </tr>
                <tr>
                    <td>Starting date:</td>
                    <td><input type="date" name = "startdate"/></td>
                </tr>
                <tr>
                    <td>Ending date:</td>
                    <td><input type="date" name = "enddate"/></td>
                </tr>
            </table>
            <input type ="submit" value ="search" name ="submit_search">
        </form>
        <%@include file = '../footer/footer.jsp'%>
    </body>
</html>
