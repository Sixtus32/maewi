<?php
namespace sixtus\maewi\models;

use DateTime;
use sixtus\maewi\lib\Model;

class Account extends Model
{
    private int $accountId;
    private string $account_info;
    private string $account_activation_code;
    private string $account_phone_number;
    private bool $isVerifed;
    private bool $account_status;
    private DateTime $account_opening_date;
    private int $userId;

    public function __construct(int $userId,
                                string $account_info,
                                string $account_activation_code,
                                string $account_phone_number,
                                bool $isVerifed,
                                bool $account_status,
                                DateTime $account_opening_date
                                )
    {
        $this->userId = $userId;
        $this->account_info = $account_info;
        $this->account_activation_code = $account_activation_code;
        $this->account_phone_number = $account_phone_number;
        $this->isVerified = $isVerifed;
        $this->account_status = $account_status;
        $this->account_opening_date = $account_opening_date;
        $this->accountId = $this->generateAccountId();
    }

    public function insertAccount()
    {
        $query = $this->prepare('INSERT INTO accounts
        (userId,account_info,
        account_activation_code,
        account_phone_number,
        verified,
        account_status,
        account_opening_date,
        accountId)
        VALUES
        (:userId,
        :account_info,
        :account_activation_code,
        :account_phone_number,
        :verified,
        :account_status,
        :account_opening_date,
        :accountId)');
        $query->execute([
            ':userId' => $this->userId,
            ':account_info' => $this->account_info,
            ':account_activation_code' => $this->account_activation_code,
            ':account_phone_number' => $this->account_phone_number,
            ':verified' => $this->isVerifed,
            ':account_status' => $this->account_status,
            ':account_opening_date' => $this->account_opening_date,
            ':accountId' => $this->accountId
        ]);
    }

    public function updateAccount()
    {
        $query = $this->prepare('UPDATE accounts SET
        userId=:userId,
        account_info=:account_info,
        account_activation_code=:account_activation_code,
        account_phone_number=:accont_phone_number,
        verified=:verified,
        account_status=:account_status,
        account_opening_date=:accont_opening_date,
        WHERE accountId=:accountId');
        $query->execute([
            ':userId' => $this->userId,
            ':account_info' => $this->account_info,
            ':account_activation_code' => $this->account_activation_code,
            ':account_phone_number' => $this->account_phone_number,
            ':verified' => $this->isVerifed,
            ':account_status' => $this->account_status,
            ':account_opening_date' => $this->account_opening_date,
            ':accountId' => $this->accountId
        ]);
    }

    public function deleteAccount()
    {
        $query = $this->prepare('DELETE FROM accounts WHERE accountId = :accountId');
        $query->execute(['accountId' => $this->accountId]);
    }

    private function generateAccountId()
    {
        $query=$this->query("SELECT max(accountId) as accountId FROM accounts");
        $data = $query->fetch();
        return ($data)?$data['accountId']+1:1;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }

    public function __set($prop, $value)
    {
        $this->$prop=$value;
    }
}