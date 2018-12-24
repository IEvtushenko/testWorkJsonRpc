<?php


namespace App\Helper;


use App\Model\ModelInterface;

class ModelMapper
{
    /**
     * @param ModelInterface $model
     * @param array $modelArray
     *
     * @return ModelInterface
     */
    public static function mapping(ModelInterface $model, array $modelArray): ModelInterface
    {
        foreach ($modelArray as $propertyName => $property) {
            if (property_exists($model, $propertyName)) {
                $setter = sprintf('set%s', ucfirst($propertyName));
                $model->$setter($property);
            }
        }
        return $model;
    }
}