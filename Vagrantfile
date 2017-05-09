# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  boxes = {
    "test" => {
      "ip" => "192.168.50.10"
    },
    "staging" => {
      "ip" => "192.168.50.11"
    },
    "production1" => {
      "ip" => "192.168.50.21"
    },
    "production2" => {
      "ip" => "192.168.50.22"
    }
  }

  boxes.each{|name, values|
    config.vm.define name do |box|
      # Box settings
      box.vm.hostname = name
      box.vm.box = "ubuntu/xenial64"

      # Network settings
      box.vm.network :private_network, ip: values["ip"]

      # Shared directory settings
      box.vm.synced_folder ".", "/vagrant", disabled: true
    end
  }
end
