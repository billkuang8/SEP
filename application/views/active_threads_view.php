    <div id="wrapper">
        
        <div id="threadbox">
      <h1><?=$folder.' Topics'?></h1>
          <a href="http://www.berkeleysep.com/active_forum">Main</a><span> -> </span><a href="javascript:void(0);"><?=$folder.' Topics'?></a>
      <hr>
      
            <?=$content;?>
      
        </div>
        <?=form_open('active_forum/thread_action/'.strtolower($folder))?>
            <input name="new_post" type="text" class="new_post" size="63" value="Insert new topic here..." />
      <div style="position: relative; left: 6%;"><textarea cols="200" rows="12" class="post" name="post"></textarea></div>
            <input name="submitmsg" type="submit" id="submitmsg" value="Add New Post" />
        </form>
        
    </div>
    
  <script type="text/javascript">
    $(document).ready(function() {
      $('.thread').mouseover(function() {
        var uploaded_by = $(this).attr('uploaded_by');
        var id = $(this).attr('id');
        var logged_in_as = "<?=$uploaded_by?>";
        var privilege = parseInt("<?=$privilege?>");
        if (logged_in_as == uploaded_by || privilege == 1 ) {
          $('#' + id + ' > .delete').show();
        }
      }).mouseout(function() {
        var uploaded_by = $(this).attr('uploaded_by');
        var id = $(this).attr('id');
        $('#' + id + ' > .delete').hide();
      });  
    });
  </script>

