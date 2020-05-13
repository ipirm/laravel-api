<?php

namespace App\Events;

use App\News;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendNewsToChanell
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
                function substrwords($text, $maxchar, $end='...') {
            if (strlen($text) > $maxchar || $text == '') {
                $words = preg_split('/\s/', $text);
                $output = '';
                $i      = 0;
                while (1) {
                    $length = strlen($output)+strlen($words[$i]);
                    if ($length > $maxchar) {
                        break;
                    }
                    else {
                        $output .= " " . $words[$i];
                        ++$i;
                    }
                }
                $output .= $end;
            }
            else {
                $output = $text;
            }
            return $output;
        }
        $this->data = $data;
        \App::setLocale('ru');
        $news = News::find($data->id);
       $filtred  = strip_tags($news->text);
       $link = 'https://covid.az/news/'.$news->slug;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET',
           'https://api.telegram.org/bot1197250746:AAF2dieqHHH-anwnL21S2H8GGpn0VVv3eHU/sendPhoto?chat_id=-1001473519134&&photo=https://www.covid.info.az/storage/'.$news->image.'&caption=<b>'.$news->title."</b>".substrwords($filtred,800).'<a href="'.$link.'">read more</a>&parse_mode=html');

        return response()->json($data);

    }
 public  function handle(){
 }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
