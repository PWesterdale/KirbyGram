## Kirby Instagram Plugin

---
### Breaking Changes - Please upgrade to v1.1.0!
---

Thanks to Tony Morris for bringing this to my attention - I was utilising the wrong end point for a users feed, so had to make several changes to fix the feed endpoint.
If you are running a version earlier that v1.1.0 then please, update your installation with the new files and run through the authorization process once more.

Apologies for any inconvenience!

---
### What does it do?
---

Social media plugins are always a bit of a pain to do as you usually have to jump through hoops to get a client account authorised, set up applications and all of that faff - It's just a huge great pain in the ass.

I'm currently building a small website for myself which required an instagram feed, so I thought what the hell, let's open source it!

Essentially I've created a third party service that will handle the authorisation of the instagram account, so all you need to do is click a few buttons and you will have the ability to put your instagram feed wherever you please.

### Installation
---

- Drop the files into your kirby plugins folder at **/site/plugins/kirbygram/**

#### If you are only on a development environment (No Internet Access):

- Visit [The Kirbygram Dev Api](http://kirbygram.threadstud.io/auth.php?dev=true)
- This will ask you to log in with the client instagram account, do so and you will be re-directed back to a page
- Follow the page instructions and copy the generated configuration into a file at **/site/plugins/kirbygram/config.json**
- Visit **http://yoursite.com/kirbygram/done**


#### If you are on a live website

- Visit **http://www.yoursite.com/kirbygram/install**
- Click the nice shiny 'Authorise' button
- Badabing Badaboom! You got yourself some instagram.

### How do I get the pretty images/videos?

There is a few code examples on the completion page of the authorisation, but this gives a little more detail on the classes and their methods.

#### Feed and Liked

These are the two basic feeds represented by this plugin, Feed is the complete user's feed whereas liked represents the latest images liked by your customer.

to query these feeds, you can use the following:

```
$instagram = new \Instagram();

// Get all of the images/videos from my feed!
$instagram->feed()->get();

// Get all of the liked images/videos from my feed!
$instagram->liked()->get();

```

That is all well and good, but you may probably want a little more control than that. Therefore you can use the following methods to limit and offset the results you are getting.

```
$instagram = new \Instagram();

// Get all of the IMAGES from my feed!
$instagram->feed()->only('image')->get();

// Get the latest four images and videos from my feed!
$instagram->feed()->limit(4)->get();

// Get the latest four images and videos from my feed except the first one!
$instagram->feed()->limit(4)->offset(1)->get();

```
#### The Media Object

Each of the above methods returns you an array of media objects, unless you set the **limit** function to 1, in which case it will return a single media object.

The Media Object exposes the following functions:

#### caption()

Gets the caption of the Instagram post. for best results pass this through the **instagram::text_format()** function

#### likes()

Returns the amount of likes for the current object.

#### link()

The url of the current object on instagram.com

#### tags()

Returns an array of tags for the current object.

#### raw()

Returns the raw instagram object - [http://instagram.com/developer](http://instagram.com/developer) may be of some interest if you want to play with this!

#### is_video()

Returns a boolean on wether this media is a video. Helpful for deducing what to do with this media object.

#### is_image()

Returns a boolean on wether this media is an image. Helpful for deducing what to do with this media object.

#### thumbnail()

The url of the thumbnail of the image/video.

#### small()

The url of the low resolution **IMAGE**

#### max()

The url of the max resolution **IMAGE**

#### small_video()

The url of the low definition **VIDEO**

#### max_video()

The url of the max definition **VIDEO**

---

I think that about covers it. Any issues please just drop them on the issue tracker and I will try and sort it out!
