<?xml version="1.0" encoding="utf-8"?>

<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:output 
    method="html" 
    indent="yes" 
    version="4.0"
    doctype-public="-//W3C//DTD HTML 4.01//EN"
    doctype-system="http://www.w3.org/TR/html4/strict.dtd"/>
  
  <xsl:template match="/">
    

    <table border="1">
   <tr><th>Item Number</th><th>Name</th><th>Category</th><th>Start Price</th><th>Reserve Price</th><th>Buy It Now Price</th><th>Current Bid Price</th><th>Start Date</th><th>Start Time</th><th>Duration</th><th>Status</th><th>Listed By</th><th>Bidder</th></tr>
	<xsl:for-each select="//item[Status='sold' or Status='failed']">
	<tr>
		<td><xsl:value-of select="Number"/></td>
		<td><xsl:value-of select="Name"/></td>
		<td><xsl:value-of select="Category"/></td>
		<td><xsl:value-of select="StartPrice"/></td>
		<td><xsl:value-of select="ReservePrice"/></td>
		<td><xsl:value-of select="BuyItNowPrice"/></td>
		<td><xsl:value-of select="CurrentBidPrice"/></td>
		<td><xsl:value-of select="StartDate"/></td>
		<td><xsl:value-of select="StartTime"/></td>
		<td><xsl:value-of select="Duration"/></td>
		<td><xsl:value-of select="Status"/></td>
		<td><xsl:value-of select="ListedBy"/></td>
		<td><xsl:value-of select="Bidder"/></td>
	</tr>
	</xsl:for-each>
</table>

	<p>Revenue from sold items:<xsl:value-of select=".03*sum(//item[Status='sold']/CurrentBidPrice)"/></p>

	<p>Revenue from failed items:<xsl:value-of select=".01*sum(//item[Status='failed']/ReservePrice)"/></p>

<p>Total Revenue is:<xsl:value-of select="(.03*sum(//item[Status='sold']/CurrentBidPrice))+(.01*sum(//item[Status='failed']/ReservePrice))"/></p>

  </xsl:template>
</xsl:stylesheet>




