<?php

namespace Payum\Paypal\ProHosted\Nvp\Action;

use ArrayAccess;
use Payum\Core\Action\ActionInterface;
use Payum\Core\Bridge\Spl\ArrayObject;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\GatewayAwareInterface;
use Payum\Core\GatewayAwareTrait;
use Payum\Core\Request\Sync;
use Payum\Paypal\ProHosted\Nvp\Request\Api\GetTransactionDetails;

class SyncAction implements ActionInterface, GatewayAwareInterface
{
    use GatewayAwareTrait;

    public function execute($request)
    {
        /** @var Sync $request */
        RequestNotSupportedException::assertSupports($this, $request);

        $model = ArrayObject::ensureArrayObject($request->getModel());

        if ($model['txn_id']) {
            $this->gateway->execute(new GetTransactionDetails($model));
        }
    }

    public function supports($request)
    {
        return $request instanceof Sync &&
            $request->getModel() instanceof ArrayAccess
        ;
    }
}
