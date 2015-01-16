# Kandy Wordpress Plugin
KANDY is about making communications simple with the KANDY platform managing all the complexity and hard stuff, while you focus on the intent of your application. KANDY manages all the elements of your voice, video, presence and messaging requirements. Accessing the power of KANDY is simple using our provided developer tools.

Home page: http://www.kandy.io/
## User guide
Kandy Wordpress Plugin help you use kandy in your website easily by following steps: 

  - Install Kandy plugin and active it
  - Goto Kandy > Settings to configure all required options.
  - Go Kandy > User Assignment to assign kandy users to your users. If you need refesh kandy users list please click sync.
  - Go Kandy > Customization to edit some script and style for your kandy components.
  - Go Pages > Add New to create a new page with kandy components by kandy shortcode.

####Kandy components and shortcode syntax:

**Kandy Video Button**: make a video call button component(video call)
```sh
[kandyVideoButton
        class = "myButtonStype"
        id = "my-video-button"
        incomingLabel = "Incoming Call..."
        incomingButtonText = "Answer"
        callOutLabel = "User to call"
        callOutButtonText = "Call"
        callingLabel = "Calling..."
        callingButtonText = "End Call"
        onCallLabel = "You are connected!"
        onCallButtonText = "End Call"]
```
**Kandy Video**: make a video component (video call)
```sh
[kandyVideo 
    title = "Me" 
    id = "myVideo" 
    style = "width: 300px; height: 225px;background-color: darkslategray;"]
  ```
  
  **Kandy Voice Button**: make a voice call button component (voice call)
```sh
[kandyVoiceButton
        class = "myButtonStype"
        id = "my-video-button"
        incomingLabel = "Incoming Call..."
        incomingButtonText = "Answer"
        callOutLabel = "User to call"
        callOutButtonText = "Call"
        callingLabel = "Calling..."
        callingButtonText = "End Call"
        onCallLabel = "You are connected!"
        onCallButtonText = "End Call"]
```
  
**Kandy Status**: make a kandy user status component (available, unavailable, awway, busy....). Kandy Status usually use with kandy address book component.
```sh
[kandyStatus
        class = "myStatusStyle"
        id = "myStatus"
        title = "My Status"]
  ```
**Kandy Adress Book**: make an address book component which list all friend in your contact.
```sh
[kandyAddressBook
        class = "myAddressBookStyle"
        id = "myContact"
        title = "My Contact"
        userLabel = "User"
        searchLabel = "Search"
        searchResultLabel = "Directory Search Results"]
  ```
  
**Kandy Chat**: make a kandy chat component which help you send instant message to your friend in contact.
```sh
[kandyChat
        class = "myChatStyle"
        id = "my-chat"
        contactLabel = "Contacts"]
  ```
  
### Quick Examples: 
**Kandy Voice Call**
```sh
[kandyVoiceButton class= "myButtonStyle" id ="my-voice-button"]
```
**Kandy Video Call**: use a video call button and two video(**myVideo** and **theirVideo** id is required).
   ```sh
[kandyVideoButton class="myButtonStype"]
[kandyVideo title="Me" id="myVideo" style = "width: 300px; height: 225px;background-color: darkslategray;"]
[kandyVideo title="Their"  id="theirVideo" style = "width: 300px; height: 225px;background-color: darkslategray;"]
```
**Kandy Presence**: use a kandystatus and kandy addressbook compobent
```sh
[kandyStatus class="myStatusStype" id="myStatus"]
[kandyAddressBook class="myAddressBookStyle" id="myContact"]
```

**Kandy Chat: **
```sh
[kandyChat class="myChatStyle" id ="my-chat"]
```
####Kandy Administration:
**Settings: ** 

- **API Key:** Kandy API key which found in your kandy account.
- **Domain Secret Key:** Domain Kandy API key which found in your kandy account.
- **Domain Name:** Domain name of you kandy account.
- **Javascript Library Url**: Link to kandy javascript library.
- **FCS Library Url**: Link to kandy FCS javascript library.
- **Jquery Reload**: If you need use kandy jquery library, set it yes.


**User assignment:**  help you synchronize kandy users from kandy server to your users system. Select your user and click edit button to assign(unassign) kandy user.

**Style customization**: help you edit kandy shortcode(video, voice, chat...) style. Select appropriate file(.css) then click edit them.

**Script customization** help you edit kandy shortcode(video, voice, chat...) script(add more behaviour). Select appropriate file(.js) then click edit them.

***All support script callback:***
```sh
window.loginsuccess_callback = function () {
   //do something when you login successfully
}
window.loginfailed_callback = function () {
    //do something when you login fail
}
window.callincoming_callback = function (call, isAnonymous) {
    //do something when your are calling
}
window.oncall_callback = function (call) {
    //do something when you are oncall
}
window.callanswered_callback = function (call, isAnonymous) {
    //do something when someone answer your call
}
window.callended_callback = function () {
   //do something when someone end  your call
}

window.answerVoiceCall_callback = function (stage) {
    //do something when you answer voice call
}

window.answerVideoCall_callback = function (stage) {
    //do something when you answer video call
}
window.makeCall_callback = function (stage) {
   //do something when you make call
}
window.endCall_callback = function (stage) {
   //do something when you click end call button
}
window.remotevideoinitialized_callack(videoTag){
   //do something with your remote video
}

window.localvideoinitialized_callback = function(videoTag){
    //do some thing with your local video
}

window.presencenotification_callack = function() {
    //do something with status notification
}
```

### Troubleshooting
- **Kandy Shortcode not working:** check your kandy api key, domain secret key for your application at **Kandy > Settings**
- **Jquery conflict**: Set Jquery reload to true at **Kandy > Settings**
- **Internationalizing**: get the /languages/kandy.pot file and make your /languages/*.mo file to locale your language.
