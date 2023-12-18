<?php

namespace App\Libraries;

class PDFMake
{
    private $setting, $allFont, $content;

    protected $images, $pageWidth, $pageHeight;

    public function __construct()
    {
        $this->_fontList();
        $this->setting = array(
            'pageOrientation' => 'potrait',
            'pageMargins' => array(60, 70, 60, 10),
            'defaultStyle' => array(
                'font' => 'Arial',
                'fontSize' => 12
            )
        );
        $this->setPageSize('A4');
        $this->content = array(
            'text' => '----- PDFMake -----',
            'bold' => true,
            'alignment' => 'center'
        );
        $this->images = array();
    }

    public function getPDF()
    {
        $pdf = $this->setting;
        $pdf['content'] = $this->content;
        $pdf['images'] = $this->images;
        return $pdf;
    }

    public function getFont()
    {
        return $this->allFont;
    }

    public function setOrientation(string $orientation = 'potrait')
    {
        $orn = array('potrait', 'landscape');
        if (in_array($orientation, $orn)) {
            $this->setting['pageOrientation'] = $orientation;
        }
        return $this;
    }

    public function setPageSize($size)
    {
        $paper = array(
            'A5' => array(419, 595),
            'A4' => array(595, 842),
            'LEGAL' => array(612, 1008),
            'LETTER' => array(612, 792)
        );
        if (is_string($size)) {
            if (array_key_exists($size, $paper)) {
                $this->setting['pageSize'] = $size;
                $this->pageWidth = $paper[$size][0];
                $this->pageHeight = $paper[$size][1];
            }
        }
        if (is_array($size) && sizeof($size) === 2) {
            $this->setting['pageSize'] = 'OTHER';
            $this->pageWidth = $size[0];
            $this->pageHeight = $size[1];
        }
        return $this;
    }

    public function setPageMargin($margin)
    {
        $this->setting['pageMargins'] = 60;
        if (is_integer($margin)) $this->setting['pageMargins'] = $margin;
        if (is_array($margin)) {
            if (!empty($margin) && sizeof($margin) < 5)
                $this->setting['pageMargins'] = $margin;
        }
        return $this;
    }

    public function setDefaultFont(string $font, int $size = 12)
    {
        $defaultFont = 'Arial';
        $defaultSize = 12;
        if (array_key_exists($font, $this->allFont)) $defaultFont = $font;
        if ($size > 5 && $size < 31) $defaultSize = $size;
        $this->setting['defaultStyle'] = array(
            'font' => $defaultFont,
            'fontSize' => $defaultSize
        );
        return $this;
    }

    protected function parse(string $text)
    {
        $result = array();
        preg_match_all('/<(.*)>(.*?)<\/\1>|([^<>]+)/', $text, $matches, PREG_SET_ORDER);
        foreach ($matches as $mc) {
            $style = array(
                'b' => 'bold',
                'i' => 'italics'
            );
            if ($mc[1] == '') {
                $result[] = $mc[3];
            } elseif (array_key_exists($mc[1], $style)) {
                $result[] = array('text' => $mc[2], $style[$mc[1]] => true);
            } elseif ($mc[1] == 'bi') {
                $result[] = array(
                    'text' => $mc[2],
                    'bold' => true,
                    'italics' => true
                );
            } else {
                $result[] = $mc[0];
            }
        }
        return array('text' => $result);
    }

    protected function setContent(array $content)
    {
        $this->content = $content;
    }

    private function _fontList()
    {
        $fontLocation = base_url('fonts');
        $this->allFont = array(
            'Arial' => array(
                'normal' => $fontLocation . '/arial.ttf',
                'bold' => $fontLocation . '/arialbd.ttf',
                'italics' => $fontLocation . '/ariali.ttf',
                'bolditalics' => $fontLocation . '/arialbi.ttf'
            ),
            'ArialNarrow' => array(
                'normal' => $fontLocation . '/ARIALN.TTF',
                'bold' => $fontLocation . '/ARIALNB.TTF',
                'italics' => $fontLocation . '/ARIALNI.TTF',
                'bolditalics' => $fontLocation . '/ARIALNBI.TTF'
            ),
            'Calibri' => array(
                'normal' => $fontLocation . '/calibri.ttf',
                'bold' => $fontLocation . '/calibrib.ttf',
                'italics' => $fontLocation . '/calibrii.ttf',
                'bolditalics' => $fontLocation . '/calibriz.ttf'
            ),
            'TimesNewRoman' => array(
                'normal' => $fontLocation . '/times.ttf',
                'bold' => $fontLocation . '/timesbd.ttf',
                'italics' => $fontLocation . '/timesi.ttf',
                'bolditalics' => $fontLocation . '/timesbi.ttf'
            )
        );
    }
}
