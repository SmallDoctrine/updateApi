<?php


class GameController
{
    private $service;

    public function __construct(GameService $service)
    {
        $this->service = $service;
    }
    public function getAllGames()
    {
        return json_encode($this->service->getAllGames());
    }

    public function getGameById($id)
    {
        return json_encode($this->service->getGameById($id));
    }

    public function addGame()
    {
        $this->service->addGame();
        return json_encode(['status' => 'игра успешно добавлена!']);
    }

    public function updateGame($id)
    {
        $this->service->updateGame($id);
        return json_encode(['status' => 'успешно обновлено!']);
    }

    public function deleteGame($id)
    {
        $this->service->deleteGame($id);
        return json_encode(['status' => 'игра удалена']);
    }

    public function getGamesByGenre($genre)
    {
        return json_encode($this->service->getGamesByGenre($genre));
    }
}
