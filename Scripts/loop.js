

$(document).ready(function() {
    $("loop").each(function(){
        let loop = $(this);
        let loopFor = $(this).attr("for");
        let loopStart = $(this).attr("start");
        let loopStop = $(this).attr("stop");
        let loopInfluence = $(this).attr("influence");
        let loopChildren = loop.children();

        for(let loopRep = loopStart; loopRep <= loopStop; loopRep++){
            let clonedChildren = loopChildren.clone();
            let elements = clonedChildren.find("*");

            elements.each(function(){
                let attributes = $(this).get(0).attributes;
                $.each(attributes, function() {
                    if (this.value.includes(loopFor)) {
                        this.value = this.value.split(loopFor).join(loopRep);
                    }
                });
                let elementText = $(this).text();
                if (elementText.includes(loopFor)) {
                    elementText = elementText.split(loopFor).join(loopRep);
                    $(this).text(elementText);
                }
            });
            clonedChildren.each(function(){
                let attributes = $(this).get(0).attributes;
                $.each(attributes, function() {
                    if (this.value.includes(loopFor)) {
                        this.value = this.value.split(loopFor).join(loopRep);
                    }
                });
                let elementText = $(this).text();
                if (elementText.includes(loopFor)) {
                    elementText = elementText.replace(loopFor, loopRep);
                    $(this).text(elementText);
                }
            });
            loop.append(clonedChildren);
        }
        
        loopChildren.remove();
        
        if (loopInfluence === "none"){
            loop.replaceWith(loop.contents());
            return;
        }
    });
});







