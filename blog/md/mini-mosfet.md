# Broke Down: The Mystery of the Melting Coil Pack

## The Mystery Melting

As an experienced software engineer with a knack for hands-on tech repairs, I recently faced a challenging yet intriguing issue with my 2015 Mini Cooper S Convertible. The car's #2 coil pack had not just failed once, but twice, melting in a way that was both baffling and concerning. Determined to get to the bottom of this, I embarked on a journey of automotive troubleshooting that tested both my patience and my technical skills.

#### **Initial Diagnosis: A Deep Dive into the Electricals**

My first step was to utilize a multimeter to trace the wiring for the problematic ignition coil. With the ECM (Engine Control Module) plugged in, I tested the power on the harness for coil #2. The voltage was present, but there was no fire signal, indicating a possible grounding issue somewhere between the coil and the ECM. After removing the wire harness from the ECM and checking end-to-end, I confirmed that none of the three wires in the harness were grounded unexpectedly. So far, so good.

#### **The Real Culprit: A Faulty MOSFET**

With my background in diagnosing and repairing electronics, I decided to take a closer look at the ECM itself. I removed the ECM and traced the leads back to the motherboard, focusing on the section responsible for cylinder #2. To my surprise, I discovered that all four ignition wires for each cylinder ran to a set of MOSFETs (Part #N171AD). Tracing cylinder #2's MOSFET, I removed it from the motherboard and, upon testing, found that the coil pack no longer melted when the ignition was on. This was a significant breakthrough!

#### **The Search for a Replacement: A Stroke of eBay Luck**

Now came the challenging part: finding a replacement component. Fortuitously, I found a "parts" ECM on eBay that seemed promising. The MOSFET in this parts ECM, while a different part number (N634AB), had specifications close enough to the original. After comparing the specs, I decided to take the plunge and replace the old MOSFET with this new one. 

#### **Success Against the Odds**

The moment of truth was both thrilling and nerve-wracking. I powered up the Mini, and to my relief and satisfaction, it worked flawlessly! The coil did not melt, the idle was smooth, and the acceleration was back to its optimal state. It was a testament to the power of persistence, technical acumen, and a little bit of luck.

#### **Final Thoughts**

This experience was a reminder of the joys and challenges of DIY repairs. It's not just about saving money or avoiding a trip to the mechanic; it's about the satisfaction of solving a complex problem and learning something new along the way. For anyone facing similar issues, remember: with the right tools, a bit of knowledge, and a willingness to dive deep, you can fix almost anything. 

Happy motoring, and keep those engines running smoothly!

