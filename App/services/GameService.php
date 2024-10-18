<?php


class GameService
{
    private $repository;

    public function __construct(GameRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllGames()
    {
        return $this->repository->getAllGames();
    }

    public function getGameById($id)
    {
        return $this->repository->getGameById($id);
    }

    public function addGame()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['title'], $data['developer'], $data['genres']))
        {
            http_response_code(400);
             json_encode(['message' => 'проверьте правильность введных данных инпутов']);
        }
        $game = new Game($data['title'], $data['developer'], $data['genres']);

        $this->repository->addGame($game);
    }

    public function updateGame($id)
    {

        $data = json_decode(file_get_contents('php://input'), true);
        // нежельтально писать один и тот же код в разных частях  ПО - DRY
        if (!isset($data['title'], $data['developer'], $data['genres']))
        {
            http_response_code(400);
             json_encode(['message' => 'проверьте правильность введных данных инпутов']);
        }
        $game = new Game($data['title'], $data['developer'], $data['genres']);

        $this->repository->updateGame($game, $id);
    }

    public function deleteGame($id)
    {
        $this->repository->deleteGame($id);
    }

    public function getGamesByGenre($genre)
    {
        return $this->repository->getGamesByGenre($genre);
    }
}
