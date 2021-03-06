<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Impl\Service\Form\ShipsList;

use Impl\Service\Validation\ValidableInterface;
use Impl\Service\Validation\AbstractLaravelValidator;
use Impl\Repo\ShipsList\ShipsListInterface;
use Impl\Repo\Order\OrderInterface;
use Impl\Service\Validation\ValidationException;

class ShipsListForm extends AbstractLaravelValidator {

    /**
     * Form data
     * 
     * @var Array
     */
    public $data = [];

    /**
     * Validator
     * 
     * @var Object \Impl\Service\Validation\ValidableInterface;
     */
    public $validator;

    /**
     * Ship
     * 
     * @var Object \Impl\Repo\Ship\ShipInterface;
     */
    public $shipsList;
    public $order;

    /**
     * 
     * @param ValidableInterface $validator
     * @param OrderInterface $ship
     */
    public function __construct(ValidableInterface $validator, ShipsListInterface $shipsList, OrderInterface $order) {

        $this->validator = $validator;
        $this->shipsList = $shipsList;
        $this->order = $order;
    }

    /**
     * validate an create an new ship
     * 
     * @param Array $input Input request
     * @return boolean true if save success
     */
    public function create(array $input) {

        if ($this->validate($input)) {
            
            return $this->shipsList->create($input);
        }

        return false;
    }

    /**
     * validate an update an new ship
     * 
     * @param Array $input Input request
     * @return boolean true if save success
     */
    public function update(array $input) {

        if ($this->validate($input)) {

            return $this->shipsList->update($input);
        }

        return false;
    }

    /**
     * Test if form validator passes
     * 
     * @param array $input Input reques
     * @return boolean true if passes
     */
    public function validate(array $input) {

        if (!$this->validator->with($input)->passes()) {

            throw new ValidationException('Validation Failed', $this->validator->errors());
        }
        return true;
    }

}
