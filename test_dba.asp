<%

'Dim sConnection, objConn , objRS 

'sConnection = "DRIVER={MySQL ODBC 3.51 Driver}; SERVER=localhost; DATABASE=testing_dbs; UID=tester;PASSWORD=testdude1; OPTION=3"

'Set MyConn = Server.CreateObject("ADODB.Connection")
'MyConn.Open "FILEDSN=c:\dsn\MyTable_dsn.dsn"

'Set adoCon = Server.CreateObject("ADODB.Connection")
'adoCon.Open "Provider=Microsoft.Jet.OLEDB.4.0; Data Source=" & Server.MapPath("testdb.mdb")


'Set objConn = Server.CreateObject("ADODB.Connection") 
'objConn.Open(sConnection) 

'Set objRS = objConn.Execute("SELECT FirstName, LastName FROM tblUsers")

Response.Write "Did this fall over? "



' While Not objRS.EOF
' Response.Write objRS.Fields("LastName") & ", " & objRS.Fields("FirstName") & "<br>"
' Response.Write & " "
' objRS.MoveNext
' Wend 

'objRS.Close
'Set objRS = Nothing

'objConn.Close
'Set objConn = Nothing




%>