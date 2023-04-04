
    // Drag and drop the image (jpg or png file upload)

(function(){
    
let placeHoldImg = "Images/placeholder-image.svg";
let dropImg = "Images/drop-image.svg";
let PNG = "image/png";
let JPG = "image/jpeg";
let dropPlace = $("#output");
let dropSrc = dropPlace.attr('src');
let imageSrc = dropSrc;

    // Upload image - button

$("#upload_image").on("change", function(e){
    let files = e.target.files[0];
    if (files){
        imageSrc = URL.createObjectURL(files);
        dropPlace.attr("src", imageSrc);
        dropPlace.on("load", function(){
            URL.revokeObjectURL(dropPlace.src);
        });
    }
});

    // Drag & Drop image

$(document).on('dragenter', function(e){
    let items = e.originalEvent.dataTransfer.items;
    let type = items[0].type;

    if (type === PNG || type === JPG){
        dropPlace.on('dragover', handleDragOver);
        dropPlace.on('drop', handleFileSelect);

        function handleDragOver(e){
            e.stopPropagation();
            e.preventDefault();
            e.originalEvent.dataTransfer.dropEffect = 'copy';
        }
        function handleFileSelect(e){
            e.stopPropagation();
            e.preventDefault();
            let files = e.originalEvent.dataTransfer.files;
            let type = files[0].type;

            if (type === PNG || type === JPG){
                imageSrc = URL.createObjectURL(files[0]);
                $('#upload_image').prop('files', files);
                dropPlace.attr("src", imageSrc);

                dropPlace.on("load", function(){
                    URL.revokeObjectURL(dropPlace.src);
                });
                
                // Remove the error class from the #file_style and the image preview (div)
                $("#file_style").removeClass('error');
                $(".form-s1-right").removeClass('error');
                $(".form-s1-image").removeClass('error');
                
                // Prevent accepting wrong type files after uploading the right type
                dropPlace.off('dragover', handleDragOver);
                dropPlace.off('drop', handleFileSelect);
            }
        }
    }
});

    // Change the image placeholder

// When dropping the image outside of the #output replace the image to placeholder
$(document).on('drop', function(e){
    e.preventDefault(); // Stop the file from opening in the other tab when dropping outside of #output
    if (imageSrc != null){
        dropPlace.attr("src", imageSrc);
    } else if (dropSrc == placeHoldImg){
        dropPlace.attr("src", placeHoldImg);
    }
});

// Replace the image to upload when dragging over the window (if png or jpg)
let isDraggingOver = false;
let dragTimer;

function dragOver(e){
    e.preventDefault();
    let items = e.originalEvent.dataTransfer.items;
    let type = items[0].type;

    if (type === PNG || type === JPG){
        dropPlace.attr("src", dropImg);
        isDraggingOver = true;
        clearTimeout(dragTimer);
    }
}

$(document).on('dragover', function(e){
    dragOver(e);
});
$("#output").on('dragover', function(e){
    dragOver(e);
});

$(document).on('dragleave', function(e){
    e.preventDefault();
    clearTimeout(dragTimer);

    dragTimer = setTimeout(function(){
        isDraggingOver = false;
        if (imageSrc != null){
            dropPlace.attr("src", imageSrc);
        } else {
            dropPlace.attr("src", placeHoldImg);
        }
    }, 20);
});

// Add / remove the dragOver (box-shadow) class on drag (if png or jpg)
$("#output").on("dragenter", function(e){
    let items = e.originalEvent.dataTransfer.items;
    let type = items[0].type;

    if (type === PNG || type === JPG){
        $(".form-s1-right").addClass("dragOver");
    }
});
$("#output").on("dragleave drop", function(){
    $(".form-s1-right").removeClass("dragOver");
});
    
})();