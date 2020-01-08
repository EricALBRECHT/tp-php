<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
   <xsl:output 
      method="html"
      encoding="UTF-8"
      doctype-public="-//W3C//DTD HTML 4.01//EN"
      doctype-system="http://www.w3.org/TR/html4/strict.dtd"
      indent="yes" />

   <xsl:template match="website">
      <html><body>
         <h1>Liste d'individus </h1>
         <ul>
            <xsl:apply-templates select="content" />
         </ul>
      </body></html>
   </xsl:template>

   <xsl:template match="individu">
      <li>
         <xsl:value-of select="@id" />
         <xsl:text> : </xsl:text>
         <xsl:value-of select="prenom"/>
				 <xsl:text>  </xsl:text>
				 <xsl:value-of select="nom"/>
      </li>
   </xsl:template>
</xsl:stylesheet>