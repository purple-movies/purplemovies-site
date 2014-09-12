<%
'Sends an email

Dim mail
Set mail = Server.CreateObject("CDO.Message")
mail.To = Request.Form("destination")
mail.From = Request.Form("from")
mail.Subject = Request.Form("subject")
mail.TextBody = Request.Form("message")
mail.Send()
Response.Write("Mail Sent!")

'Destroy the mail object!
Set mail = nothing
%>
