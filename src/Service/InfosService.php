<?php

namespace App\Service;

class InfosService
{
    private HorlogeService $horloge;
    private string $host;
    private string $serviceInfosParam;
    private int $value;

    /**
     * @param HorlogeService $horloge
     * @param string $host
     * @param string $serviceInfosParam
     * @param int $value
     */
    public function __construct(HorlogeService $horloge, string $host, string $serviceInfosParam, int $value)
    {
        $this->horloge = $horloge;
        $this->host = $host;
        $this->serviceInfosParam = $serviceInfosParam;
        $this->value = $value;
    }

    /**
     * @return HorlogeService
     */
    public function getHorloge(): HorlogeService
    {
        return $this->horloge;
    }

    /**
     * @param HorlogeService $horloge
     */
    public function setHorloge(HorlogeService $horloge): void
    {
        $this->horloge = $horloge;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getServiceInfosParam(): string
    {
        return $this->serviceInfosParam;
    }

    /**
     * @param string $serviceInfosParam
     */
    public function setServiceInfosParam(string $serviceInfosParam): void
    {
        $this->serviceInfosParam = $serviceInfosParam;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    public function getInfos() : string
    {
        $res='<p>Heure: '.$this->horloge->getHorloge().'<p/>';
        $res.='<p>Host: '.$this->host.'<p/>';
        $res.='<p>Param du service infos: '.$this->serviceInfosParam.'<p/>';
        $res.='<p>Valeur en dur: '.$this->value;
        return $res;
    }
}