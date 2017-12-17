<?php
namespace app\modules\product\models;

use yii\base\Model;
use yii\helpers\Html;
use yii\web\UploadedFile;

class ImageUploader extends Model
{
    public $uploadedFiles;

    public function rules()
    {
        return [
            [['uploadedFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 10]];
    }

    public function upload($productId)
    {
        if ($this->validate()) {
            $imageCount = 1;
            foreach ($this->uploadedFiles as $file) {
                while (file_exists('img/products/id-' . $productId . '-' . $imageCount . '.png')) $imageCount++;

                if ($file->extension == 'png') {
                    $file->saveAs('img/products/id-' . $productId . '-' . $imageCount . '.png');
                } else if ($file->error == UPLOAD_ERR_OK) {
                    imagepng(imagecreatefromstring(file_get_contents($file->tempName)), 'img/products/id-' . $productId . '-' . $imageCount . '.png', 9, PNG_ALL_FILTERS);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function getProductImages($productId)
    {
        $images = [];
        $imageCount = 1;

        while (file_exists('img/products/id-' . $productId . '-' . $imageCount . '.png')) {
            $images[] = Html::img('@web/img/products/id-' . $productId . '-' . $imageCount . '.png', ['class' => 'img-responsive img-modal']);
            $imageCount++;
        }

        if ($imageCount == 1) {
            $images[] = Html::img('@web/img/products/no-image.png', ['class' => 'img-responsive']);
        }

        return $images;
    }

    public function deleteImage($imageName) // TODO Check if secure
    {
        unlink('img/products/' . $imageName);
        $count = explode("-", $imageName);
        $productId = $count[1];
        $imageCount = explode(".", $count[2]);
        $imageCount = $imageCount[0];
        $imageCount++;
        while (file_exists('img/products/id-' . $productId . '-' . $imageCount . '.png')) {
            $newName = strval($imageCount - 1);
            rename('img/products/id-' . $productId . '-' . $imageCount . '.png', 'img/products/id-' . $productId . '-' . $newName . '.png');
            $imageCount++;
        }
    }

    public function deleteAllImages($id) // TODO Check if secure
    {
        $imageCount = 1;
        while (file_exists('img/products/id-' . $id . '-' . $imageCount . '.png')) {
            unlink('img/products/id-' . $id . '-' . $imageCount . '.png');
            $imageCount++;
        }
    }

    public function setMain($imageName) // TODO Check if secure
    {
        $count = explode("-", $imageName);
        $productId = $count[1];
        $imageCount = explode(".", $count[2]);
        $imageCount = $imageCount[0];

        rename('img/products/id-' . $productId . '-1.png', 'img/products/id-' . $productId . '-tmp.png');
        rename('img/products/id-' . $productId . '-' . $imageCount . '.png', 'img/products/id-' . $productId . '-1.png');
        rename('img/products/id-' . $productId . '-tmp.png', 'img/products/id-' . $productId . '-' . $imageCount . '.png');
    }
}