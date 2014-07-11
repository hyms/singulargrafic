<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.uploadify.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $("#fileUpload").fileUpload({
        'uploader': '<?php echo Yii::app()->baseUrl; ?>/images/uploader.swf',
        'cancelImg': '<?php echo Yii::app()->baseUrl; ?>/images/cancel.png',
        'script': '/uploadify/upload',
        'folder': '<?php echo Yii::app()->baseUrl; ?>/images/',
        'fileDesc': 'Image Files',
        'fileExt': '*.jpg;*.jpeg;*.gif;*.png',
        'multi': <?php echo $mult; ?>,
        'buttonText': 'agregar foto',
        'displayData': 'speed',
        'simUploadLimit': 1,
        'onComplete': complete,
        onError: function (a, b, c, d) {
        if (d.status == 404)
            alert('Could not find upload script. Use a path relative to: '+'<?= getcwd() ?>');
        else if (d.type === "HTTP")
           alert('error '+d.type+": "+d.status);
        else if (d.type ==="File Size")
           alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
        else
           alert('error '+d.type+": "+d.text);
        },
    });

    function complete(evnt, queueID, fileObj, response, data) {
        alert("La Foto se ha subido satisfactoriamente!");
    }
});
function startUpload () {
    var params = '&newFileName='+$('#photo_name').val()
    $('#fileUpload').fileUploadSettings('scriptData', params);
    $('#fileUpload').fileUploadStart();
}
</script>
