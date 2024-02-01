//-------------------------------------------------------------------------
function mountLabelRichEditor(id,label,required,above){
	var caminho = '#'+id+'+.note-editor>';
	document.querySelector(caminho+'.note-dropzone>.note-dropzone-message').innerHTML = label;
	document.querySelector(caminho+'.note-dropzone').style.display = 'block';
	document.querySelector(caminho+'.note-dropzone').style.backgroundColor = 'transparent';
	document.querySelector(caminho+'.note-dropzone>.note-dropzone-message').style.padding = '4px';
	document.querySelector(caminho+'.note-dropzone>.note-dropzone-message').style.fontSize = '14px';
	if (!above){             
		document.querySelector(caminho+'.panel-heading').style.paddingLeft=document.querySelector(caminho+'.note-dropzone>.note-dropzone-message').offsetWidth+'px';
		document.querySelector(caminho+'.note-dropzone').style.minHeight=document.querySelector(caminho+'.panel-heading').style.offsetHeight+'px';
		document.querySelector(caminho+'.note-dropzone').style.marginTop=window.getComputedStyle(document.querySelector(caminho+'.panel-heading>.btn-group')).marginTop;
	} else {
		document.querySelector(caminho+'.panel-heading').style.paddingTop='18px';
	}
	var colorLabel=(required)?'red':'black';
	document.querySelector(caminho+'.note-dropzone>.note-dropzone-message').style.color = colorLabel;
}

//-------------------------------------------------------------------------
function prepareAndShowRichEditor(id,label,options_json){
	var options = JSON.parse(options_json);	
	
	if(!! options.maxlength && options.maxlength > 0) {
        options.callbacks = {
		onKeydown: function(e) {
			var l = thtmleditor_get_length( $(e.currentTarget).html()) + 1;

			if (l > options.maxlength) {
				var allowedKeys = [8, 33, 34, 35, 36, 37, 38, 39, 40, 45, 46];
				if (! allowedKeys.includes(e.keyCode))
				e.preventDefault();
			}
		},
		onKeyup: function(e) {
			var l = thtmleditor_get_length( $(e.currentTarget).html());
			$('#'+id).next('.note-editor').find('.counter').html(l+'/'+options.maxlength);
		},
		onPaste: function(e) {
			e.preventDefault();
		}
		}
    }

	$('#'+id).summernote(options);

	if (label){
		mountLabelRichEditor(id,label,options.required,false);
	}
	//dont show bar to resize
	document.querySelector('#'+id+'+.note-editor>.note-statusbar>.note-resizebar').style.display="none";
	
	if(!! options.maxlength && options.maxlength > 0) {
        let content = $('#'+id).parent().find('.note-editable').html();
        let length = thtmleditor_get_length(content);
        $('#'+id).next('.note-editor').append(
            '<small style="position:absolute;bottom:10px;right:4px;" class="counter">' + length + '/' + options.maxlength + '</small>'
        );
    }

	if (typeof $('#'+id).next('.note-editor')[0] !== 'undefined')
    {
        var container = $('#'+id).next('.note-editor')[0];
        $(container).css('margin', $('#'+id).css('margin'));
    }
	
}
