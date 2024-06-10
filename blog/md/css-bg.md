# Painting with Code: Unveiling the Magic Behind CSS Gradient Backgrounds
<style>
.bg0 {
    --s: 50px;
    --c1: #5E412F;
    --c2: #FCEBB6;

    background:
        radial-gradient(25% 50%, var(--c1) 98%, #0000) var(--s) 0/calc(2*var(--s)) var(--s),
        radial-gradient(25% 50%, var(--c2) 98%, #0000) 0 0/calc(2*var(--s)) var(--s),
        repeating-conic-gradient(var(--c1) 0 25%, var(--c2) 0 50%) 0 0/calc(2*var(--s)) calc(2*var(--s));
}

.bg1 {
    --s: 200px;
    /* control the size */
    --c1: #1d1d1d;
    --c2: #4e4f51;
    --c3: #3c3c3c;

    background:
        repeating-conic-gradient(from 30deg, #0000 0 120deg, var(--c3) 0 180deg) calc(.5*var(--s)) calc(.5*var(--s)*0.577),
        repeating-conic-gradient(from 30deg, var(--c1) 0 60deg, var(--c2) 0 120deg, var(--c3) 0 180deg);
    background-size: var(--s) calc(var(--s)*0.577);
}

.bg2 {
    --s: 84px;
    /* control the size*/
    --c1: #f2f2f2;
    --c2: #cdcbcc;
    --c3: #999999;

    --_g: 0 120deg, #0000 0;
    background:
        conic-gradient(from 0deg at calc(500%/6) calc(100%/3), var(--c3) var(--_g)),
        conic-gradient(from -120deg at calc(100%/6) calc(100%/3), var(--c2) var(--_g)),
        conic-gradient(from 120deg at calc(100%/3) calc(500%/6), var(--c1) var(--_g)),
        conic-gradient(from 120deg at calc(200%/3) calc(500%/6), var(--c1) var(--_g)),
        conic-gradient(from -180deg at calc(100%/3) 50%, var(--c2) 60deg, var(--c1) var(--_g)),
        conic-gradient(from 60deg at calc(200%/3) 50%, var(--c1) 60deg, var(--c3) var(--_g)),
        conic-gradient(from -60deg at 50% calc(100%/3), var(--c1) 120deg, var(--c2) 0 240deg, var(--c3) 0);
    background-size: calc(var(--s)*1.732) var(--s);
}

.bg3 {
    --s: 72px;
    /* control the size */

    background:
        radial-gradient(#C02942 24%, #0000 25%),
        radial-gradient(#53777A 30%, #0000 32%) calc(var(--s)/2) calc(var(--s)/2),
        repeating-conic-gradient(from 30deg, #ECD078 0 30deg, #D95B43 0 90deg);
    background-size: var(--s) var(--s);
}

.bg4 {
    --s: 100px;
    /* control the size */
    --c1: #fff0e5;
    --c2: #025d8c;
    --c3: #e1642a;


    --_g: 50%, #0000 37%, var(--c1) 39% 70%, #0000 72%;
    --_t: 50%, var(--c2) 40deg, var(--c3) 0 140deg, var(--c2) 0 180deg, #0000 0;
    --_s: 47% 50% at;
    background:
        radial-gradient(var(--_s) -10% var(--_g)) 0 calc(var(--s)/2),
        radial-gradient(var(--_s) -10% var(--_g)) calc(var(--s)/2) 0,
        radial-gradient(var(--_s) 110% var(--_g)),
        radial-gradient(var(--_s) 110% var(--_g)) calc(var(--s)/2) calc(var(--s)/2),
        conic-gradient(from 0deg at 55% var(--_t)) calc(var(--s)/4) 0,
        conic-gradient(from 180deg at 45% var(--_t)) calc(var(--s)/4) 0,
        var(--c2);
    background-size: var(--s) var(--s);
}

.bg5 {
    --s: 150px;
    /* control the size */
    --c1: #f7d2a1;
    --c2: #05057e;

    --_g:
        var(--c1) 0% 5%, var(--c2) 6% 15%, var(--c1) 16% 25%, var(--c2) 26% 35%, var(--c1) 36% 45%,
        var(--c2) 46% 55%, var(--c1) 56% 65%, var(--c2) 66% 75%, var(--c1) 76% 85%, var(--c2) 86% 95%,
        #0000 96%;
    background:
        radial-gradient(50% 50% at 100% 0, var(--_g)),
        radial-gradient(50% 50% at 0 100%, var(--_g)),
        radial-gradient(50% 50%, var(--_g)),
        radial-gradient(50% 50%, var(--_g)) calc(var(--s)/2) calc(var(--s)/2) var(--c1);
    background-size: var(--s) var(--s);
}

.bg6 {
    --s: 105px;
    /* control the size */
    --c1: #b9b9b9;
    --c2: #dcdcdc;
    --c3: #fafafa;

    background:
        conic-gradient(from 75deg, var(--c1) 15deg, var(--c2) 0 30deg, #0000 0 180deg,
            var(--c2) 0 195deg, var(--c1) 0 210deg, #0000 0) calc(0.5*var(--s)) calc(0.5*var(--s)/0.577),
        conic-gradient(var(--c1) 30deg, var(--c3) 0 75deg, var(--c1) 0 90deg, var(--c2) 0 105deg,
            var(--c3) 0 150deg, var(--c2) 0 180deg, var(--c3) 0 210deg, var(--c1) 0 256deg,
            var(--c2) 0 270deg, var(--c1) 0 286deg, var(--c2) 0 331deg, var(--c3) 0);
    background-size: var(--s) calc(var(--s)/0.577);
    /* 0.577=tan(30deg)*/
}

.bg7 {
    --s: 120px;
    /* control the size */

    background:
        conic-gradient(from 150deg at 50% 33%, #0000, #FA6900 .5deg 60deg, #0000 60.5deg) calc(var(--s)/2) calc(var(--s)/1.4),
        conic-gradient(from -30deg at 50% 66%, #0000, #D95B43 .5deg 60deg, #ECD078 60.5deg);
    background-size: var(--s) calc(var(--s)/1.154);
}

.bg8 {
    --s: 100px;
    /* control the size */
    --c1: #4ECDC4;
    --c2: #556270;

    background:
        linear-gradient(-26.56deg, var(--c1) 33%, var(--c2) 33.3% 66.6%, var(--c1) 67%) 0/var(--s) var(--s);
    /* 26.56deg = arctan(0.5) */
}


.bg9 {
    --s: 140px;
    /* control the size */

    --_g: #0000 52%, #170409
        /* first color */
        54% 57%, #0000 59%;
    background:
        radial-gradient(farthest-side at -33.33% 50%, var(--_g)) 0 calc(var(--s)/2),
        radial-gradient(farthest-side at 50% 133.33%, var(--_g)) calc(var(--s)/2) 0,
        radial-gradient(farthest-side at 133.33% 50%, var(--_g)),
        radial-gradient(farthest-side at 50% -33.33%, var(--_g)),
        #67917A;
    /* second color */
    background-size: calc(var(--s)/4.667) var(--s), var(--s) calc(var(--s)/4.667);
}
.bg-sample {
  display: block;
  height: 10rem;
}
</style>
I program recreationally. There. I've said it. I like to code. I like to code so much, that I'll have 3 or 4 projects outside my normal work that I actively engage on, just for fun. Often the results of these side projects can be lackluster, for my-eyes-only, just me testing out some new technologies or techniques. This is not one of those times. I went on a deep-dive into the world of CSS backgrounds; a world much more fascinating than I originally thought it would be. Come join me on my experimental journey to push the boundaries of CSS, exploring the depths of gradient backgrounds.
The following 10 CSS rules are standalone, meaning they don't require anything other than what's in the rule. You can download the entire set from [here](https://cdr2.com/crblog/blog/code/bg.css). I really went a little crazy and have dozens more but we'll start with just these 10:

#### The Geometric Dance - `.bg0`
<div class="bg-sample bg0"></div> 
<details><summary>.bg0 - The Geometric Dance CSS</summary>
```
.bg0 {
    --s: 50px;
    --c1: #5E412F;
    --c2: #FCEBB6;

    background:
        radial-gradient(25% 50%, var(--c1) 98%, #0000) var(--s) 0/calc(2*var(--s)) var(--s),
        radial-gradient(25% 50%, var(--c2) 98%, #0000) 0 0/calc(2*var(--s)) var(--s),
        repeating-conic-gradient(var(--c1) 0 25%, var(--c2) 0 50%) 0 0/calc(2*var(--s)) calc(2*var(--s));
}
```
</details>
Starting off, I played with radial gradients and a repeating conic gradient to craft `.bg0`. The result was a mesmerizing geometric pattern that seemed to dance across the screen. The blend of earthy tones created a warm, inviting texture that felt like a digital tapestry.

#### The Triangular Symphony - `.bg1`
<div class="bg-sample bg1"></div> 
<details><summary>.bg1 - "The Triangular Symphony" CSS</summary>
```
.bg1 {
    --s: 200px;
    /* control the size */
    --c1: #1d1d1d;
    --c2: #4e4f51;
    --c3: #3c3c3c;

    background:
        repeating-conic-gradient(from 30deg, #0000 0 120deg, var(--c3) 0 180deg) calc(.5*var(--s)) calc(.5*var(--s)*0.577),
        repeating-conic-gradient(from 30deg, var(--c1) 0 60deg, var(--c2) 0 120deg, var(--c3) 0 180deg);
    background-size: var(--s) calc(var(--s)*0.577);
}
```
</details>
With `.bg1`, I ventured into the realm of sharp angles and crisp lines. The repeating conic gradients formed a symphony of triangles, each layer playing its tune. The monochromatic scheme added a sophisticated, modern edge to the design.

#### The Kaleidoscopic Vision - `.bg2`
<div class="bg-sample bg2"></div> 
<details><summary>.bg2 - "The Kaleidoscopic Vision" CSS</summary>
```
.bg2 {
    --s: 84px;
    /* control the size*/
    --c1: #f2f2f2;
    --c2: #cdcbcc;
    --c3: #999999;

    --_g: 0 120deg, #0000 0;
    background:
        conic-gradient(from 0deg at calc(500%/6) calc(100%/3), var(--c3) var(--_g)),
        conic-gradient(from -120deg at calc(100%/6) calc(100%/3), var(--c2) var(--_g)),
        conic-gradient(from 120deg at calc(100%/3) calc(500%/6), var(--c1) var(--_g)),
        conic-gradient(from 120deg at calc(200%/3) calc(500%/6), var(--c1) var(--_g)),
        conic-gradient(from -180deg at calc(100%/3) 50%, var(--c2) 60deg, var(--c1) var(--_g)),
        conic-gradient(from 60deg at calc(200%/3) 50%, var(--c1) 60deg, var(--c3) var(--_g)),
        conic-gradient(from -60deg at 50% calc(100%/3), var(--c1) 120deg, var(--c2) 0 240deg, var(--c3) 0);
    background-size: calc(var(--s)*1.732) var(--s);
}
</details>
`.bg2` was an exploration of symmetry and color. By positioning conic gradients at strategic angles, I created a kaleidoscopic effect that captivated the eye. The subtle color transitions added depth, making the pattern almost leap off the screen.

#### The Circle Saga - `.bg3`
<div class="bg-sample bg3"></div>
<details><summary>.bg3 - The Circle Sage CSS</summary>
```
.bg3 {
    --s: 72px;
    /* control the size */

    background:
        radial-gradient(#C02942 24%, #0000 25%),
        radial-gradient(#53777A 30%, #0000 32%) calc(var(--s)/2) calc(var(--s)/2),
        repeating-conic-gradient(from 30deg, #ECD078 0 30deg, #D95B43 0 90deg);
    background-size: var(--s) var(--s);
}
```
</details>
In `.bg3`, circles took center stage. I juxtaposed radial gradients to form a pattern that was both harmonious and intriguing. The contrasting colors added a dynamic rhythm, turning the background into a visual saga.

#### The Sunset Mirage - `.bg4`
<div class="bg-sample bg4"></div>
<details><summary>.bg4 - The Sunset Mirage</summary>
```
.bg4 {
    --s: 100px;
    /* control the size */
    --c1: #fff0e5;
    --c2: #025d8c;
    --c3: #e1642a;


    --_g: 50%, #0000 37%, var(--c1) 39% 70%, #0000 72%;
    --_t: 50%, var(--c2) 40deg, var(--c3) 0 140deg, var(--c2) 0 180deg, #0000 0;
    --_s: 47% 50% at;
    background:
        radial-gradient(var(--_s) -10% var(--_g)) 0 calc(var(--s)/2),
        radial-gradient(var(--_s) -10% var(--_g)) calc(var(--s)/2) 0,
        radial-gradient(var(--_s) 110% var(--_g)),
        radial-gradient(var(--_s) 110% var(--_g)) calc(var(--s)/2) calc(var(--s)/2),
        conic-gradient(from 0deg at 55% var(--_t)) calc(var(--s)/4) 0,
        conic-gradient(from 180deg at 45% var(--_t)) calc(var(--s)/4) 0,
        var(--c2);
    background-size: var(--s) var(--s);
}
```
</details>
Drawing inspiration from the sky at dusk, `.bg4` became my sunset mirage. The radial and conic gradients mimicked the sun's glow, fading into the horizon. The play of warm and cool tones created a serene, picturesque backdrop.

#### The Colorful Carousel - `.bg5`
<div class="bg-sample bg5"></div>
<details><summary>.bg5 - The Colorful Carousel</summary>
```
.bg5 {
    --s: 150px;
    /* control the size */
    --c1: #f7d2a1;
    --c2: #05057e;

    --_g:
        var(--c1) 0% 5%, var(--c2) 6% 15%, var(--c1) 16% 25%, var(--c2) 26% 35%, var(--c1) 36% 45%,
        var(--c2) 46% 55%, var(--c1) 56% 65%, var(--c2) 66% 75%, var(--c1) 76% 85%, var(--c2) 86% 95%,
        #0000 96%;
    background:
        radial-gradient(50% 50% at 100% 0, var(--_g)),
        radial-gradient(50% 50% at 0 100%, var(--_g)),
        radial-gradient(50% 50%, var(--_g)),
        radial-gradient(50% 50%, var(--_g)) calc(var(--s)/2) calc(var(--s)/2) var(--c1);
    background-size: var(--s) var(--s);
}
```
</details>
With `.bg5`, I aimed to inject vibrancy and movement. The radial gradients created a carousel of colors, spinning with life. It was a celebration of hues, each turn revealing a new shade, a new emotion.

#### The Wheel of Fortune - `.bg6`
<div class="bg-sample bg6"></div> 
<details><summary>.bg6 - The Wheel of Fortune</summary>
```
.bg6 {
    --s: 105px;
    /* control the size */
    --c1: #b9b9b9;
    --c2: #dcdcdc;
    --c3: #fafafa;

    background:
        conic-gradient(from 75deg, var(--c1) 15deg, var(--c2) 0 30deg, #0000 0 180deg,
            var(--c2) 0 195deg, var(--c1) 0 210deg, #0000 0) calc(0.5*var(--s)) calc(0.5*var(--s)/0.577),
        conic-gradient(var(--c1) 30deg, var(--c3) 0 75deg, var(--c1) 0 90deg, var(--c2) 0 105deg,
            var(--c3) 0 150deg, var(--c2) 0 180deg, var(--c3) 0 210deg, var(--c1) 0 256deg,
            var(--c2) 0 270deg, var(--c1) 0 286deg, var(--c2) 0 331deg, var(--c3) 0);
    background-size: var(--s) calc(var(--s)/0.577);
    /* 0.577=tan(30deg)*/
}
```
</details>
`.bg6` was a nod to the classic wheel of fortune. The conic gradients formed segments of color, each representing a slice of fate. The design was both playful and mesmerizing, inviting users to take a spin.

#### The Radiant Burst - `.bg7`
<div class="bg-sample bg7"></div>
<details><summary>.bg7 - The Radiant Burst CSS</summary>
```
.bg7 {
    --s: 120px;
    /* control the size */

    background:
        conic-gradient(from 150deg at 50% 33%, #0000, #FA6900 .5deg 60deg, #0000 60.5deg) calc(var(--s)/2) calc(var(--s)/1.4),
        conic-gradient(from -30deg at 50% 66%, #0000, #D95B43 .5deg 60deg, #ECD078 60.5deg);
    background-size: var(--s) calc(var(--s)/1.154);
}
```
</details>
I sought to capture the explosive beauty of a starburst with `.bg7`. The conic gradients radiated from specific points, creating a burst of color and light. It was a spectacle of radiance, a burst of energy frozen in time.

#### The Striped Illusion - `.bg8`
<div class="bg-sample bg8"></div>
<details><summary>.bg8 - The Striped Illusion</summary>
```
.bg8 {
    --s: 100px;
    /* control the size */
    --c1: #4ECDC4;
    --c2: #556270;

    background:
        linear-gradient(-26.56deg, var(--c1) 33%, var(--c2) 33.3% 66.6%, var(--c1) 67%) 0/var(--s) var(--s);
    /* 26.56deg = arctan(0.5) */
}
```
</details>
In `.bg8`, I experimented with linear gradients to create an optical illusion. The stripes, angled precisely, offered a sense of movement and depth. The alternating colors played tricks on the eye, making the static background seem alive.

#### The Shadow Play - `.bg9`
<div class="bg-sample bg9"></div>
<details><summary>.bg9 - The Shadow Play CSS</summary>
```
.bg9 {
    --s: 140px;
    /* control the size */

    --_g: #0000 52%, #170409
        /* first color */
        54% 57%, #0000 59%;
    background:
        radial-gradient(farthest-side at -33.33% 50%, var(--_g)) 0 calc(var(--s)/2),
        radial-gradient(farthest-side at 50% 133.33%, var(--_g)) calc(var(--s)/2) 0,
        radial-gradient(farthest-side at 133.33% 50%, var(--_g)),
        radial-gradient(farthest-side at 50% -33.33%, var(--_g)),
        #67917A;
    /* second color */
    background-size: calc(var(--s)/4.667) var(--s), var(--s) calc(var(--s)/4.667);
}
```
</details>
`.bg9` was an exploration of shadows and light. The radial gradients, placed off-center, created an interplay of light and dark. It was a mysterious, enigmatic pattern that invited curiosity and contemplation.

Through these experiments, I discovered the limitless possibilities of CSS gradients. Each background was a step into the unknown, a testament to the power of code to create beauty. As I continue my journey, I'm reminded that in the world of web design, the only limit is our imagination.
