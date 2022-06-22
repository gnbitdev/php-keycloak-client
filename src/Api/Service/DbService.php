<?php
declare(strict_types=1);

namespace KeycloakApiClient\Api\Service;

use KeycloakApiClient\DB;

class DbService
{

    private $conn;

    public function __construct(DB $conn, string $realm)
    {
        // postgres connection
        $this->conn        = $conn;
        $this->pdo         = $conn->getConnection();
        $this->realm       = $realm;
    }

    
    /**
     * groupsByUsers
     *
     * @return array
     */
    public function groupsByUsers() : array
    {
        return $this->pdo
        ->query('SELECT * FROM keycloak_group JOIN user_group_membership ON keycloak_group.id = user_group_membership.group_id')
        ->fetchAll();
    }
    
    /**
     * rolesByUsers
     *
     * @return array
     */
    public function rolesByUsers(): array
    {
        return $this->pdo
        ->query('SELECT * FROM keycloak_role JOIN user_role_mapping ON keycloak_role.id = user_role_mapping.role_id')
        ->fetchAll();
    }

    
    /**
     * syncRolesOnUser
     *
     * @param  array $roleNames
     * @param  string $userId
     * @return bool
     */
    public function syncRolesOnUser(array $roleNames, string $userId) : bool
    {
        $this->pdo->beginTransaction();

        try{
    
            // delete bind values

            $this->pdo->prepare("DELETE FROM user_role_mapping WHERE user_id='".$userId."'")->execute();

            // insert roles
            foreach ($roleNames as $roleName) {

                // get role id
                $roleId = $this->pdo->query("SELECT id FROM keycloak_role WHERE name='".$roleName."' AND realm_id='". $this->realm."'")->fetch()['id'];

                // insert role
                $this->pdo->prepare("INSERT INTO user_role_mapping (user_id, role_id) VALUES ('".$userId."', '".$roleId."')")->execute();
            }

            $this->pdo->commit();

            return true;

        }catch(\Exception $e)
        {
            // print_r($e->getMessage());exit;

            $this->pdo->rollBack();
            
            return false;
        }
    }
    
    /**
     * syncGroupsOnUser
     *
     * @param  array $groups
     * @param  string $userId
     * @return bool
     */
    public function syncGroupsOnUser(array $groupNames, string $userId) : bool
    {
        $this->pdo->beginTransaction();

        try{
    
            $this->pdo->prepare("DELETE FROM user_group_membership WHERE user_id='". $userId."'")->execute();


            foreach ($groupNames as $groupName) {

                // get group id
                $groupId = $this->pdo->query("SELECT id FROM keycloak_group WHERE name='".$groupName."' AND realm_id='". $this->realm."'")->fetch()['id'];

                // insert group
                $this->pdo->prepare("INSERT INTO user_group_membership (user_id, group_id) VALUES ('".$userId."', '".$groupId."')")->execute();
            }

            $this->pdo->commit();

            return true;

        }catch(\Exception $e)
        {
            $this->pdo->rollBack();
            
            return false;
        }
    }    
}
