<!-- BEGIN: main -->
<div id="content">
	<div class="breadcrumb"><a href="/admin">Admin</a> &gt; About</div>
	<div class="heading" id="hd_about"></div>
	<form name="frm_about" id="frm_about" enctype="multipart/form-data" action="/admin/about" method="post">
    <table id="tbl_about_main" width="600px">
    	    	<tr>
        	<td colspan="2">
				<table id="meta" border="0">
                	<tr>
                    	<th colspan="2">Meta Tags</th>
                    </tr>
                    <tr>
                        <td valign="top">Title: </td>
                        <td valign="top"><input type="text" name="meta_title" value="{META_TITLE}" size="86"/></td>
					</tr>
                    <tr>
                        <td valign="top">Keywords: </td>
                        <td valign="top"><input type="text" name="meta_keywords" value="{META_KEYWORDS}" size="86"/></td>
                    </tr>
                    <tr>
                        <td valign="top">Description: </td>
                        <td valign="top"><textarea name="meta_desc" cols="86" rows="3">{META_DESC}</textarea></td>
                    </tr>
				</table>
			</td>
    	</tr>
		<tr>
        	<td>
            	<textarea name="content_main" cols="75" rows="30">{CONTENT_MAIN}</textarea>
            </td>
		</tr>
        <tr>
        	<td>
            	<input type="submit" value="Save" name="save" />
            	<input type="reset" value="Reset" />
			</td>
		</tr>        
    </table>
    </form>
</div>
<div class="clear"></div>
<!-- END: main -->