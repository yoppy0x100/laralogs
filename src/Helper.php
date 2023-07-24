<?php 

namespace Yoppy0x100\LaraLogs;

use Jenssegers\Agent\Agent;
use Yoppy0x100\LaraLogs\Locations;
use Yoppy0x100\LaraLogs\Model\Logs;

class Helper
{
    protected $ua;
    protected $agent;
    protected $template;

    public function __construct(protected $request)
    {
        $this->initator();
        $this->ua = $this->request->userAgent() ?? '';
    }
    
    public function location()
    {
        return new Locations($this->request->ip());
    }

    private function initator()
    {
        $this->agent = new Agent();
        $this->agent->setUserAgent($this->request->userAgent());
        $this->agent->setHttpHeaders($this->request->headers);
    }

    private function baseTemplate() : array
    {
        return [
            'ip' => $this->ip(),
            'location' => $this->location()->city(),
            'method' => $this->method(),
            'device' => $this->device(),
            'url' => $this->url(),
            'path' => $this->path(),
            'browser' => $this->browser(),
            'platform' => $this->platform(),
            'useragent' => $this->useragent(),
            'languages' => $this->languages(),
            'request' => $this->request(),
            'referer' => $this->referer(),
            'headers' => $this->headers(),
        ];
    }

    public function log(array $customTemplate=null) : void
    {
        $this->template = $this->baseTemplate();
        if(isset($customTemplate) and !empty($customTemplate)) {
            $this->template =  array_merge($this->template, $customTemplate);
        }

        Logs::create($this->template);
    }

    public function getLog()
    {
        return Logs::all();
    }

    /* Available Type
    *   path : default
    *   url 
    */
    public function getVisitorCount($type='path')
    {
        $data = [];
        $keyna = Logs::select($type)->distinct()->get();
        foreach ($keyna as $name) {
            $data[] = [
                $type => $name->$type,
                'total_visitor' => Logs::where($type,  $name->$type)->count(),
            ];
        }

        return $data;
    }
}