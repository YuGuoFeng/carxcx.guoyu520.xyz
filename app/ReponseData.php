<?php

namespace App;

class ReponseData
{

    


    public static function rMsg($code = 200, $message = '')
    {

        $data = array(
            'code' => $code,
            'msg' => $message,
            'data' => []
        );

        return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public static function rMsgData($code = 200, $message = '', $data)
    {

        return  response()->json(
            array(
                'code' => $code,
                'msg' => $message,
                'data' => $data
            )
        )->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public static function tryMsg($e,$code=404,$type="api"){
        $edata = [
            'getMessage' => $e->getMessage(),
            'getFile'    => $e->getFile(),
            'getLine'    => $e->getLine(),
        ];
        $data = array(
            'code' => $code,
            'msg' => $e->getMessage(),
            'data' => $edata
        );
        \Log::info($type, $edata);
        return response()->json($data)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public static function rPFormat($pagination)
    {
        $data=[ 'page' => $pagination->currentPage(),
                'size' => $pagination->perPage(),
                'total' => $pagination->total(),
                'isLast' => $pagination->lastPage(),
                "content" => $pagination->items()
            ];

        $return = array(
            'code' => 200,
            "msg" => "",
            'data' => $data

        );
        return response()->json($return)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public static function reponsePaginationFormat2($pagination,$content)
    {

        $data=[ 'page' => $pagination->currentPage(),
                'size' => intval($pagination->perPage()),
                'total' => $pagination->total(),
                'isLast' => $pagination->lastPage(),
                "content" => $content
            ];

        $return = array(
            'code' => 200,
            "msg" => "",
            'data' => $data

        );
        return response()->json($return)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
