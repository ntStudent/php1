<?php
class ArticleModel
{
    const DB = 'data';
    public function getAll()
    {
        // $this->extractData('ddf.txt');
        return $this->extractData(scandir(self::DB));

        // или так
        // return scandir(ArticleModel::DB);
    }

    protected function extractData(array $arr)
    {
        $res = [];
        foreach ($arr as $value) {
            $buffer = [];
            if ($value != '.' && $value != '..'){
                $buffer['name'] = explode('.', $value)[0];
                $buffer['id'] = explode('_', $buffer['name'])[1];
                $res[$buffer['id']]['id'] = $buffer['id'];
                $res[$buffer['id']]['name'] = $buffer['name'];
            }
        }

        return $res;
    }
}
