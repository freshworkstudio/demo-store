<?php
namespace Freshwork\Metable;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Metadata
 * @package Freshwork\Metable
 */
trait Metadata
{
    /**
     * @return HasMany
     */
    public function metadata()
    {
        return $this->morphMany(\App\Metadata::class, 'metable');
    }

    /**
     * @param $key
     * @param $value
     * @param null $tag
     * @return $this
     */
    public function addMeta($key, $value, $tag = null)
    {
        $this->metadata()->create([
            'key'    => $key,
            'value' => $value,
            'tag'   => $tag
        ]);

        return $this;
    }

    /**
     * @param $key
     * @param null $tag
     * @return mixed
     */
    public function getMeta($key, $tag = null)
    {
        $query = $this->metadata()->where('key', $key);
        if ($tag !== null)$query->where('tag', $tag);
        return $query->get();
    }

    public function loadMeta($tag = null)
    {

        $query = $this->metadata();
        if ($tag !== null)$query->where('tag', $tag);
        $metas = $query->get();
        foreach($metas as $data)
        {
            $key = $data['key'];
            $var = $data['tag'] ? $data['tag'] : 'meta';
            if (!isset($this->$var)) $this->$var = new \stdClass();
            $this->$var->$key = $data['value'];
        }

        return $this;
    }

}