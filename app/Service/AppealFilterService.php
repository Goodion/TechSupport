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
        $this->filters = $request->filters;
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

    public function not_closed($value)
    {
        $this->values = $value->allOpened();
    }

    public function answered($value)
    {
        $this->values = $value->filter(function ($item) {
            return $item->feedbacks->isNotEmpty();
        })->all();
    }
}
