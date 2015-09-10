<!-- BEGIN: main -->

<div id="content">
	<div class="breadcrumb"><a href="/admin">Admin</a> &gt; Gallery</div>
	<div class="heading" id="hd_gallery"></div>
    <!-- BEGIN: errs -->
    <div class="err">
    	<!-- BEGIN: err -->
    	<p>{ERR}</p>
    	<!-- END: err -->
    </div>
    <!-- END: errs -->
    <!-- BEGIN: msgs -->
    <div class="msg">
    	<!-- BEGIN: msg -->
    	<p>{MSG}</p>
    	<!-- END: msg -->
    </div>
    <!-- END: msgs -->
	<div class="clear"></div>
	<form name="frm_gallery" id="frm_gallery" enctype="multipart/form-data" action="/admin/gallery" method="post">
    <table name="tbl_gallery_upload" id="tbl_gallery_upload">
    	<!--<tr>
        	<td>
            	{SEL_IMAGES}
            </td>
            <td>
            	<input type="button" name="up" value="Move Up" /><br />
            	<input type="button" name="down" value="Move Down" /><br />
                <input type="button" name="delete" value="Delete" />
                <input type="submit" name="save" value="Save" />
            </td>
        </tr>-->
    	<tr>
        	<td class="label">Image File:</td>
            <td class="value">
            	<input type="file" name="f_image" />
            </td>
        </tr>
    	<tr>
        	<td class="label">Image Thumbnail File:</td>
            <td class="value">
            	<input type="file" name="f_image_tn" />
            </td>
        </tr>
    	<tr>
        	<td class="label">Image Title:</td>
            <td class="value">
            	<input type="text" size="39" name="title" />
            </td>
        </tr>
    	<tr>
        	<td class="label">Image Caption:</td>
            <td class="value">
            	<textarea name="caption" rows="5" cols="30"></textarea>
            </td>
        </tr>
        <tr>
        	<td>&nbsp;</td>
            <td class="buttons">
            	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            	<input type="submit" name="upload" value="Upload" />
                <input type="reset" value="Reset" />
            </td>
        </tr>
    </table>
    <table name="tbl_gallery_sort" id="tbl_gallery_sort">
    	<tr>
        	<td class="label">Gallery Sort</td>
		</tr>
        <tr>
        	<td>
            	<textarea name="gallery_sort" rows="20" columns="10">{LST_SORT}</textarea>
            </td>
		</tr>
        <tr>
        	<td>
            	<input type="submit" value="Save" name="save_sort" />
            	<input type="reset" value="Reset" />
			</td>
		</tr>
    </table>
    </form>
</div>
<div class="clear"></div>
<!-- END: main -->
        