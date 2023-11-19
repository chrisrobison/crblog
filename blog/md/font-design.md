# Font Fundamentals: The Vital Role of Font Choice in Web and Mobile Design

As digital experiences continue to evolve, the choice of fonts in web and mobile design plays a pivotal role in shaping user engagement and readability. The concept of optical sizing, a design practice where typefaces are tailored for different display sizes, is especially crucial in this context. Let's delve into why font choice matters and how you can implement it effectively in your designs.

Before diving into the specifics of font choice in digital design, let's establish a foundation by understanding some font fundamentals. Typography is not just about choosing a pretty typeface; it's about communication, readability, and enhancing the user experience.

## Font Vocabulary

The print design ecosystem has a vocabulary all their own. Western society has been pressing out books since 1454 (see what I did there?) and the list of words we use to describe how the print looks on paper has grown to be quite large. Seemingly similar concepts have subtle differences (see Legibility vs Readability, Typeface vs Font). 

Yet, we use many of these terms everyday; Did you know we get the words "UPPERCASE" and "lowercase" from the original Movable Type Printing Press? The UPPERCASE letters were held in the, well in the upper case of the press. I'll leave it as an exercise to the reader to discover where the lowercase letters were stored or just a tall tale.

Here's a list of some basic terminology in the world of fonts and print design:

1. **Typeface vs. Font**: A typeface is the design of the lettering (e.g., Times New Roman), while a font is a specific style and size of that typeface (e.g., Times New Roman, 12pt, Bold).

2. **Serif vs. Sans Serif**: Serif typefaces, like Times New Roman, have small lines at the end of their strokes, while sans-serif typefaces, like Arial, do not. Serifs are traditionally seen as more formal, while sans-serifs are viewed as modern and clean.

3. **Legibility vs. Readability**: Legibility refers to how easily individual characters can be distinguished, while readability is about how easy it is to read and understand blocks of text.

4. **Hierarchy and Emphasis**: Different fonts and styles (like bold or italic) are used to create a hierarchy or to emphasize certain parts of the content.

5. **Consistency**: Consistency in using fonts is crucial for creating a cohesive and harmonious design. Too many different font styles can be distracting or even worse, disorientating.

## Key Considerations

When we need a font, most of us will just scroll through the 'Font' menu until we see a font we like. But for any choice you need to make, you need to do your due diligence by defining the parameters and constraints your final choice will need to stay within. The choice of font you use will be driven by a number of things:

1. **Target Audience**: The choice of font should resonate with the target audience. For example, a children's app might use a more playful font compared to a corporate website.

2. **Platform**: The platform (web, mobile, app) dictates font choices due to varying screen sizes and resolutions.

3. **Brand Identity**: Fonts should align with the brand's personality – whether it’s formal, friendly, or avant-garde.

4. **Accessibility**: Consider users with visual impairments. Fonts should be legible and sizable to accommodate all users.

5. **Performance**: Heavier font files can slow down site speed, impacting user experience and SEO.

Now that we've covered the basics, let’s explore the importance of font choice in web and mobile design, including the innovative world of variable and color fonts.

## Understanding Optical Sizing

<figure style="float:right; width:400px;border-left:2px solid #0004;">
<img src="/crblog/assets/img/optical-font.svg" style="width:400px;float:right;">
<figcaption style="text-align:center; font-size:0.7em;"><em>Example of Font with optical sizing</em></figcaption>
</figure>

Optical sizing refers to the customization of typefaces for specific sizes. This practice, deeply rooted in the history of typography, ensures that text remains legible and aesthetically pleasing across different mediums and sizes. For instance, fonts designed for body text are optimized for readability at smaller sizes, with features like larger x-heights and wider characters, while display fonts are crafted for impact at larger sizes.

## Why Font Choice Matters in Digital Design

Font choices in print and web design are crucial for several reasons. Since I love to make lists, how about another list:

1. **User Engagement**: The right font can improve user engagement. A well-chosen font can make text more appealing and inviting, encouraging visitors to stay longer on a website or read more of a printed piece.

2. **Enhanced Readability**: On smaller screens, fonts with larger x-heights and open spacing prevent straining the eyes, making content more accessible.

3. **Tone and Mood Setting**: Fonts can convey different moods and tones. For instance, a serif font like Times New Roman might convey formality and tradition, suitable for a law firm's website, while a sans-serif font like Arial might feel more modern and informal, fitting for a tech startup.

4. **Brand Identity**: Fonts can be a powerful tool in conveying your brand's personality and values.

5. **Professionalism and Credibility**: A well-chosen font can enhance the professional appearance of a design, lending credibility to the content. Poor font choices can have the opposite effect, making a design look amateurish.

6. **Compatibility and Performance**: On the web, font choice can affect loading times and compatibility across different devices and browsers. Some fonts are optimized for web use and ensure consistent rendering across various platforms.

7. **Adaptability Across Devices**: With an increasing variety of screen sizes, from desktops to smartwatches, fonts must be versatile and legible across all platforms.

As you can see, fonts are a very important and integral part of how you communicate with your audience. I must admit, I thought this would be a quick short blog entry on using color fonts but the more I researched and wrote, the more I realized how deeply influencial font choices can be and how underappreciated print design is. Well now that we've got the fundamentals out of the way, let's get to the good stuff.

## Implementing Fonts in Web and Mobile Design

We are going to take a look at how to implement this in practice using [Google Fonts](https://fonts.google.com/), a popular and versatile repository of fonts provided by Google that are free to use. They provide a variety of styles including some very convicing handwriting fonts.

### HTML/CSS Example with Google Fonts

First, choose a font from [Google Fonts](https://fonts.google.com/). For this example, we’ll use 'Roboto', a highly legible sans serif font for web and mobile interfaces, 'Noto Serif', a very legible serif font and pair those with 'Shadows Into Light' as a companion font. Feel free to look through Google's font collection and pick your own. 

Let's take a look at that markup:

#### HTML

```html
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@300&family=Roboto:wght@300;400;700&family=Shadows+Into+Light&display=swap" rel="stylesheet">
    <title>Font Example</title>
</head>
<body>
    <h1>Heading Styled with Roboto</h1>
    <p>This paragraph is styled with Roboto, optimized for readability.</p>
    <p class='serif'>Good font combinations <span class='cursive'>Emphasize</span> the right words..</p>
</body>
</html>
```

#### CSS

```css
body {
    font-family: 'Roboto', sans-serif;
}

h1 {
    font-family: 'Roboto', sans-serif;
    font-size: 2em; /* Larger size for headings */
    font-weight: 700; /* Bolder weight for impact */
}

p {
    font-size: 1em; /* Standard size for body text */
    font-weight: 400; /* Regular weight for readability */
}

.serif {
    font-family: 'Noto Serif', serif;
    font-size: 1rem;
    width: 80rem;
    border-radius: 1rem;
    height: 4rem;
    background-color: #ccc;
}

.cursive {
    font-family: 'Shadows Into Light', cursive;
    font-size: 1.2rem;
}

```

#### Result
<img src='/crblog/assets/img/font-example1.png' width="100%">

## The Future with Variable and Color Fonts

### Variable Fonts

Variable fonts represent a significant advancement in digital typography. They allow a single font file to behave like multiple fonts, offering a range of styles, weights, and widths. This is particularly beneficial in web and mobile design for several reasons:

1. **Efficiency**: A single variable font file can replace multiple font files, reducing load times and improving website performance.
   
2. **Flexibility**: Designers can fine-tune the style, weight, or width of the font dynamically, offering greater creative control over typography.

3. **Improved User Experience**: They allow for real-time adjustment of fonts according to user preferences or device characteristics, enhancing accessibility.

<figure style="float:right;">
<img src="/crblog/assets/img/variable.svg" width="100%">
<figcaption style="font-size:0.7rem;text-align:center;"><em>Variations can be combined. The first example has a light weight and body-like optical size; the second has a heavy weight and display-like optical size (note the higher contrast); the third also has a similarly heavy weight, but with a body-like optical size.</em></figcaption>
</figure>

Using a variable font is as easy as using a normal, non-variable font. The only difference is the size of the variable font file can be quite a bit larger as they must store more information for each character. Something to keep in mind if you are targeting mobile users or users with slow connections. Here’s how you can implement a variable font using Google Fonts:

#### HTML

```html
<!DOCTYPE html>
<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Flex&display=swap" rel="stylesheet">
    <title>Font Example</title>
</head>
<body>
    <h1>Heading Styled with Roboto</h1>
    <p>This paragraph is also styled with Roboto, optimized for readability.</p>
</body>
</html>
```

#### CSS

```css
body {
    font-family: 'Roboto Flex', sans-serif;
    font-variation-settings: 'wght' 400, 'wdth' 100;
}

h1 {
    font-size: 2em; /* Larger size for headings */
    font-weight: 700; /* Bolder weight for impact */
}

p {
    font-size: 1em; /* Standard size for body text */
    font-weight: 400; /* Regular weight for readability */
}
```

<img src="/crblog/assets/img/roboto-flex.png" style="width:100%">

As you can see, implementing a variable font is identical to using a normal font, we just update the font to download and change the CSS to reflex the new font name. If anything it's even easier as we do not need to specify each weight and varient we want to use as they are all included in the variable font. So in this example, you can adjust the `wght` and `wdth` associated with 'Roboto Flex' to change how the weight and width axes are rendered. You can adjust these values throughout your CSS to suit your design needs.

## Color Fonts
### Uses and Abuses

I love color fonts. There are some purists out there that feel text should only be a single color, black. They cite readability concerns and start mumbling something about [Edward Tufte](https://www.edwardtufte.com/) and <span style='font-family:"Comic Sans MS"'>ComicSans</span>. But color fonts, also known as chromatic fonts, are the latest innovation in typography and they bring the richness of color and texture into text. While this opens up new possibilities for branding and design, allowing fonts to include multiple colors, gradients, and even textures it also provides opportunity for creating designs that are busy and difficult to read. In web design, color fonts can be used to:

1. **Enhance Branding**: Color fonts can include brand colors and textures, making text an integral part of the brand identity.

2. **Improve Visual Interest**: They add a new dimension to typography, making it more visually appealing.

3. **Create Consistent Aesthetics**: Using color fonts can ensure consistent color schemes across different platforms.

4. **Provide icons for UI or social networks**: Including icons in a font in nothing new (see [FontAwesome](https://fontawesome.com/)), color fonts allow us to go a step further and create our own bespoke fonts containing all the social service and user interface icons we need for our site or application. 

<figure>
<img src="/crblog/assets/img/color-fonts.jpg" width="90%">
<figcaption style="font-size:0.8em;text-align:center;"><em>Some OpenType Color Fonts</em></figcaption>
</figure><br>

### How They Work

A color font file is actually just a regular font file that embeds additional data to display more graphic properties than the contour shapes of a character.

Color fonts are now generally stored as SVG data inside OpenType font files. This SVG (Scalable Vector Graphics) format can hold vector shapes with color or gradients, and may also include bitmap images - thus leading to bitmap fonts.

On top of all this, While doing research for this article I discovered that color fonts are now officially referred as <b>OpenType-SVG fonts</b>.

You're probably thinking how simple, straightfoward and level-headed this all sounds. Nothing but sunshine and rainbow fonts. Right?

Well, the reality is a bit more complex...

### Time For Some History 

The OpenType-SVG font format was initially designed by Mozilla & Adobe and became an industry standard in early 2016, when other big players including Microsoft & Google agreed on a single format to support color fonts.

<img src="data:image/png;base64,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" width="200" style="float:right">
All of them (including Apple) have previously developed and implemented their own proprietary color formats to display emojis on their operating systems, while many other companies built other custom color font technologies for the gaming, video or print industries.

There are now four major color font formats that fit into regular font files: SBIX, COLR, CBDT and SVG, each having it own specificities. Read the full story [here](https://pixelambacht.nl/2014/multicolor-fonts/) or check out my simplified recap: 

|                   |Vector|Bitmap|Native support|
|-------------------|------|------|--------------|
| W3C [SVG]       	|✔     |✔     |macOS 10.14+, iOS 12+, Windows 10+|
| Apple [SBIX]		|      |✔     |macOS and iOS |
| Google [CBDT]		|      |✔     |Android       |
| Microsoft [COLR]	|✔     |      |Windows 8.1+  |

Due to the differences and incompatibilities of these formats, the design industry is going through a transition period during which several color font formats may be needed to ensure cross-platform compatibility across several operating systems, browsers and apps.

But OpenType-SVG seems in great position to become a golden standard now that <b>three operating systems support OpenType-SVG fonts</b>: Windows 10, macOS Mojave, and iOS 12.

A solution to mitigate this issue on legacy software? Color fonts can also include some alternate <b>vector shape data as a fallback solution</b> for software that do not (yet) support any of the embedded color formats.

## What's the Catch?
### File size

So as you've probably guessed by now, there are drawbacks to color fonts. The biggest one is filesize (see what I did there?). A color font file is generally larger than a regular font file, and a lot more so when the font embeds high-resolution bitmap characters.

Whereas fonts usually weigh 10-100 kilobytes, color vector fonts can reach 100KB to 2MB+ depending on their visual complexity.

Color bitmap fonts may range from a few megabytes to tens of megabytes, and sizes increase when multiple color font formats are embedded in a single file. 

### Implementation

Implementing color fonts can be as simple as using them in your CSS, similar to regular fonts. However, it’s important to ensure compatibility, as support for color fonts can vary across different browsers and devices. Color fonts hijack a feature for rendering of diacritic marks, such as umlauts (¨), over vowels in order to render multiple layers of charaters over each other in order to achieve the effect. Just be sure to test thoroughly in all your potential environments to ensure proper rendering when using color fonts.

## Final Thoughts

The world of web and mobile typography is becoming more vibrant and alive with the advent of these latest font capabilities. These innovations offer designers unprecedented flexibility and creative possibilities, making it an exciting time to be in web and mobile design. As always, the key is to balance creativity with functionality, ensuring that your design choices enhance the user experience. The right font choice is key to creating an engaging and accessible digital experience. By considering optical sizing and using tools like Google Fonts, designers can craft visually appealing and functional web and mobile interfaces. Remember, typography is not just about making words readable; it's about bringing content to life.


