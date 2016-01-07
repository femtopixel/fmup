<?php
namespace FMUP\Import\Iterator;

/**
 * Permet de parcourir un csv ligne par ligne
 *
 * @author jyamin
 *
 */
class CsvIterator implements \Iterator
{
    const COMMA_SEPARATOR = ',';
    const SEMICOLON_SEPARATOR = ';';
    const TABULATION_SEPARATOR = "\t";

    protected $path;
    private $fHandle;
    private $current;
    private $line;
    private $separator;

    /**
     * @param string $path
     * @param string $separator optional (if null, autodetect)
     */
    public function __construct($path = "", $separator = self::SEMICOLON_SEPARATOR)
    {
        $this->setPath($path)->setSeparator($separator);
    }

    /**
     * @param string $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @throws \Exception
     */
    public function rewind()
    {
        if (!file_exists($this->path)) {
            throw new \Exception("Le fichier specifie n'existe pas ou est introuvable");
        }
        $this->fHandle = fopen($this->path, "r");
        rewind($this->fHandle);
        $this->next();
        $this->line = 0;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->current;
    }

    public function next()
    {
        $this->current = fgetcsv($this->fHandle, 0, $this->getSeparator());
        $this->line++;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        if (feof($this->fHandle)) {
            fclose($this->fHandle);
            return false;
        }
        return true;
    }

    /**
     * Get separator
     * @return string
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * Set separator
     * @param string $separator
     * @return self
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;
        return $this;
    }

    public function key()
    {
        return $this->line;
    }
}
