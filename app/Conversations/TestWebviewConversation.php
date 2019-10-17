<?php

namespace App\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Facebook\Extensions\Element;
use BotMan\Drivers\Facebook\Extensions\ElementButton;
use BotMan\Drivers\Facebook\Extensions\GenericTemplate;
use BotMan\Drivers\Facebook\Extensions\MediaAttachmentElement;
use BotMan\Drivers\Facebook\Extensions\MediaTemplate;
use BotMan\Drivers\Facebook\Extensions\MediaUrlElement;

class TestWebviewConversation extends Conversation
{
    private $image_url = "https://images.unsplash.com/photo-1571144010390-9b5cf588f9b2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2134&q=80";
    private $app_url = "https://6c97ef14.ngrok.io/webview"; //To change every time
    /**
     * Start the conversation.
     *
     * @return mixed
     */
    public function run()
    {
        $this->say("Okay you wanted to access the webview right? Here you go.");
//        $template = MediaTemplate::create();
//        $template->element(MediaUrlElement::create('image')
//            ->url($this->image_url)
//            ->addButton(ElementButton::create('Tell me more')
//                ->type('postback')
//                ->payload('Tell me more')
//            )
////            ->addButton(ElementButton::create('Documentation')
////                ->url($this->app_url)
////            )
//        );
        $template = GenericTemplate::create()
                ->addImageAspectRatio(GenericTemplate::RATIO_SQUARE)
                ->addElement(
                    Element::create('Simple Webview Template')
                        ->subtitle("All about Webview")
                        ->image($this->image_url)
                        ->addButton(ElementButton::create("visit")
                        ->url($this->app_url)->enableExtensions())
                        ->addButton(ElementButton::create('tell me more')
                            ->payload('tellmemore')
                            ->type('postback')
                        )
                );
        $this->bot->reply($template);
        return;
    }
}
