<?php


namespace App\Service;


use App\Appeal;
use Illuminate\Http\Request;

class AppealFilterService
{
    protected $filters;
    protected $values;

    public function setFilters(Request $request)
    {
        $filters = collect($request->all())->filter(function ($value, $key) {
            return mb_stripos($key, 'filters') !== false ?? $value;
        })->values()->collapse()->toArray();

        $this->filters = $filters;
        return $this;
    }

    public function apply($values)
    {
        $this->values = $values;

        if($this->filters) {
            foreach ($this->filters as $filter) {
                if(method_exists($this, $filter)) {
                    $this->$filter($this->values);
                }
            }
        }

        return $this->values;
    }

    public function unViewed($value)
    {
        $this->values = $value->where('viewed', 0);
    }

    public function viewed($value)
    {
        $this->values = $value->where('viewed', 1);
    }

    public function notClosed($value)
    {
        $this->values = $value->where('closed', 0);
    }

    public function closed($value)
    {
        $this->values = $value->where('closed', 1);
    }

    public function answered($value)
    {
        $this->values = $value->filter(function ($item) {
            return $item->feedbacks->isNotEmpty();
        })->all();
    }

    public function notAnswered($value)
    {
        $this->values = $value->filter(function ($item) {
            return $item->feedbacks->isEmpty();
        })->all();
    }
}
