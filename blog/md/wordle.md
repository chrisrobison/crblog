Wordle: A better cheat tool for Wordle

I have a friend who likes to play Wordle. If you're not familiar, Wordle is a game where you get 5 attempts to guess a 5 letter word. After each guess, you are told which letters are in the correct position, in the word but in the wrong place or not in the word at all. So this game got me thinking about the best algorthim you could use for figuring out the 5 letter word so I wrote a [little tool](/wordle-solver) to explore the problem a little. 

Initially, I thought there could only be one of each letter but I was wrong. They will throw words with double O's or three S's like "books" or "sassy" which makes things a bit more difficult but not impossible. My process was this:

1. Get dictionary list of Wordle 5-letter words (8,938 words total)
2. Analyse for letter frequencies to find best starting word
3. Cross-reference against word frequency list[s]
4. Create tool to assist in word probe
5. Profit!

There are 8,938 five letter words in total with the following overall letter counts:
```
s: 4649
e: 4586
a: 3991
o: 2986
r: 2918
i: 2638
l: 2442
t: 2321
n: 2033
d: 1730
u: 1699
c: 1485
y: 1403
p: 1393
m: 1342
h: 1217
g: 1115
b: 1097
k: 961
f: 791
w: 693
v: 476
z: 249
x: 210
j: 186
q: 79
```

This is a count of how many times each letter was found in any position in a word in our list. So the ten most popular letters overall are S, E, A, O, R, I, L, T, N, and D.

I also made letter frequency counts for each letter position within the word. The following table contains my results:

```

```

so we should try and start with a word containing those. 
I like "ARISE" or "RAISE" or "TRAIN" and then go from there. My tool allows you to specify correct, misplaced and incorrect letters and provides you with a list of words that match. You can then sort that list of words by their english word frequency and the top of those words tend to be the answer.
Allow me to demonstrate.

