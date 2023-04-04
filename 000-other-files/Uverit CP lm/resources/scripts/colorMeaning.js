    /* Color Meaning */

var sym = "Symbolizes: ";

        /* Red */

var redDesc = "The color of passion and energy. Red draws attention like no other color and radiates a strong and powerful energy that motivates us to take action. It is also linked to sexuality and stimulates deep and intimate passion. Red is ubiquitously used to warn and signal caution and danger.";

var redSym = "action, passion, motivation, attention, courage, desire";

        /* Orange */

var orangeDesc = "The color of enthusiasm and emotion. Orange exudes warmth and joy and is considered a fun color that provides emotional strength. It is optimistic and upliftning, adds spontaneity and positivity to life and it encourages social communication and creativity. It is a youthful and energetic color.";

var orangeSym = "youth, enthusiasm, upliftment, stimulation, spontaneity, creativity";

        /* Yellow */

var yellowDesc = "The color of happiness and optimism. Yellow is a cheerful and energetic color that brings fun and joy to the world. It makes learning easier as it affects the logical part of the brain, stimulating mentality and perception. It inspires thought and curiosity and boosts enthusiasm and confidence.";

var yellowSym = "happiness, intellect, inspiration, energy, warmth, perception";

        /* Green */

var greenDesc = "The color of harmony and health. Green is a generous, relaxing color that revitalizes our body and mind. It balances our emotions and leaves us feeling safe and secure. It also gives us hope, with promises of growth and prosperity, and it provides a little bit of luck to help us along the way.";

var greenSym = "safety, health, balance, relax, generosity, hope";

        /* Turquoise */

var turquoiseDesc = "The color of calmness and clarity. Turquoise stabilizes emotions and increases empathy and compassion. It emits a cool calming peace, gives us a boost of positive mental energy that improves concentration and clarifies our mind, and creates a balance that clears the path to spiritual growth.";

var turquoiseSym = "calmness, communication, stabilization, balance, concentration, empathy";

        /* Blue */

var blueDesc = "The color of trust and loyalty. Blue has a calming and relaxing effect on our psyche, that gives us peace and makes us feel confident and secure. It dislikes confrontation and too much attention, but it is an honest, reliable and responsible color and you can always count on its support.";

var blueSym = "security, trust, support, protection, confidence, honesty";

        /* Purple */

var purpleDesc = "The color of spirituality and imagination. Purple inspires us to divulge our innermost thoughts, which enlightens us with wisdom of who we are and encourages spiritual growth. It is often associated with royalty and luxury, and its mystery and magic sparks creative fantasies.";

var purpleSym = "imagination, royality, upliftment, inspiration, compassion, wisdom";

        /* Pink */

var pinkDesc = "The color of love and compassion. Pink is kind and comforting, full of sympathy and compassion, and makes us feel accepted. Its friendly, playful spirit calms and nurtures us, bringing joy and warmth into our lives. Pink is also a feminine and intuitive color that is bursting with pure romance.";

var pinkSym = "love, feminity, sympathy, comfort, kindness, intuition";

        /* Brown */

var brownDesc = "The color of stability and reliability. Brown is dependable and comforting. A great counselor and friend full of wisdom. You can count on its help if you need an honest opinion, support and protection. It stabilizes us, helps us stay grounded and inspires us to appreciate the simple things in life.";

var brownSym = "stability, honesty, protection, simplicity, appreciation, wisdom";

        /* Black */

var blackDesc = "The color of power and sophistication. Black is an incredibly strong and intimidating color that exudes authority and makes us feel secure and protected. Often seen at formal and prestigious events, this mysterious marvel arouses and seduces our senses with its elegance and sexiness.";

var blackSym = "power, elegance, seductiveness, security, authority, prestige";

        /* Gray */

var grayDesc = "The color of compromise and control. Gray is neutral, conservative and unemotional. It is practically solid as a rock, making it incredibly stable, reliable and calming. It has a peaceful, relaxing and soothing presence. Gray avoids attention but offers mature, insightful advice to anyone who asks.";

var graySym = "neutrality, practicality, stability, calmness, maturity, intellect";

        /* White */

var whiteDesc = "The color of purity and innocence. White is a true balance of all colors and is associated with cleanliness, simplicity and perfection. It loves to make others feel good and provides hope and clarity by refreshing and purifying the mind. It also promotes open-mindedness and self-reflection.";

var whiteSym = "purity, perfection, refreshment, simplicity, openness, clarity";

        /* Main Color */

var colorMeaning = document.querySelector('.color-meaning').innerHTML.slice(0, -10);

var colorMeaningA = document.querySelector('.color-meaningA');
var colorMeaningB = document.querySelector('.color-meaningB');

switch (colorMeaning) {
    case "Red":
        colorMeaningA.innerHTML = redDesc;
        colorMeaningB.innerHTML = sym + redSym;
    break;
    case "Orange":
        colorMeaningA.innerHTML = orangeDesc;
        colorMeaningB.innerHTML = sym + orangeSym;
    break;
    case "Yellow":
        colorMeaningA.innerHTML = yellowDesc;
        colorMeaningB.innerHTML = sym + yellowSym;
    break;
    case "Green":
        colorMeaningA.innerHTML = greenDesc;
        colorMeaningB.innerHTML = sym + greenSym;
    break;
    case "Turquoise":
        colorMeaningA.innerHTML = turquoiseDesc;
        colorMeaningB.innerHTML = sym + turquoiseSym;
    break;
    case "Blue":
        colorMeaningA.innerHTML = blueDesc;
        colorMeaningB.innerHTML = sym + blueSym;
    break;
    case "Purple":
        colorMeaningA.innerHTML = purpleDesc;
        colorMeaningB.innerHTML = sym + purpleSym;
    break;
    case "Pink":
        colorMeaningA.innerHTML = pinkDesc;
        colorMeaningB.innerHTML = sym + pinkSym;
    break;
    case "Brown":
        colorMeaningA.innerHTML = brownDesc;
        colorMeaningB.innerHTML = sym + brownSym;
    break;
    case "Black":
        colorMeaningA.innerHTML = blackDesc;
        colorMeaningB.innerHTML = sym + blackSym;
    break;
    case "Gray":
        colorMeaningA.innerHTML = grayDesc;
        colorMeaningB.innerHTML = sym + graySym;
    break;
    case "White":
        colorMeaningA.innerHTML = whiteDesc;
        colorMeaningB.innerHTML = sym + whiteSym;
    break;  
}

        /* Secondary Color */

var colorMeaning2 = document.querySelector('.color-meaning2').innerHTML.slice(0, -10);

var colorMeaning2A = document.querySelector('.color-meaning2A');
var colorMeaning2B = document.querySelector('.color-meaning2B');

switch (colorMeaning2) {
    case "Red":
        colorMeaning2A.innerHTML = redDesc;
        colorMeaning2B.innerHTML = sym + redSym;
    break;
    case "Orange":
        colorMeaning2A.innerHTML = orangeDesc;
        colorMeaning2B.innerHTML = sym + orangeSym;
    break;
    case "Yellow":
        colorMeaning2A.innerHTML = yellowDesc;
        colorMeaning2B.innerHTML = sym + yellowSym;
    break;
    case "Green":
        colorMeaning2A.innerHTML = greenDesc;
        colorMeaning2B.innerHTML = sym + greenSym;
    break;
    case "Turquoise":
        colorMeaning2A.innerHTML = turquoiseDesc;
        colorMeaning2B.innerHTML = sym + turquoiseSym;
    break;
    case "Blue":
        colorMeaning2A.innerHTML = blueDesc;
        colorMeaning2B.innerHTML = sym + blueSym;
    break;
    case "Purple":
        colorMeaning2A.innerHTML = purpleDesc;
        colorMeaning2B.innerHTML = sym + purpleSym;
    break;
    case "Pink":
        colorMeaning2A.innerHTML = pinkDesc;
        colorMeaning2B.innerHTML = sym + pinkSym;
    break;
    case "Brown":
        colorMeaning2A.innerHTML = brownDesc;
        colorMeaning2B.innerHTML = sym + brownSym;
    break;
    case "Black":
        colorMeaning2A.innerHTML = blackDesc;
        colorMeaning2B.innerHTML = sym + blackSym;
    break;
    case "Gray":
        colorMeaning2A.innerHTML = grayDesc;
        colorMeaning2B.innerHTML = sym + graySym;
    break;
    case "White":
        colorMeaning2A.innerHTML = whiteDesc;
        colorMeaning2B.innerHTML = sym + whiteSym;
    break;  
}
