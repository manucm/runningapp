<?php

namespace App\Clases\Excel;

use Maatwebsite\Excel\Files\ExcelFile;
use Input;

class UserListImport extends ExcelFile {

  protected $originalName;

  protected $orginalExtension;

  public function getFile()
   {

     // Import a user provided file
      $file = Input::file('file');

      $this->originalName = $file->getClientOriginalName();

      // Return it's location
      return $file->getPathname();
   }

   public function getFileName() {
        return $this->originalName;
    }

    public function getExtension() {
        $name = $this->getFileName();

        if (!$name)
            return false;
        return collect(explode('.', $name))->last();
    }


   public function getFilters()
   {
       return [
           'chunk'
       ];
   }

}
